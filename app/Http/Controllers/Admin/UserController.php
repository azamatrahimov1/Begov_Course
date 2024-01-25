<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->where('name', '!=', 'Dostonbek')
            ->orderBy('end_date')
            ->when(request('search'), function ($query) {
                $query->where('name', 'LIKE', '%' . request('search') . '%');
                $query->Orwhere('email', 'LIKE', '%' . request('search') . '%');
                $query->Orwhere('created_at', 'LIKE', '%' . request('search') . '%');
                $query->Orwhere('phone_number', 'LIKE', '%' . request('search') . '%');
                $query->Orwhere('end_date', 'LIKE', '%' . request('search') . '%');
            })
            ->paginate(10);

        $roles = Role::orderBy('name')->where('name', '!=', 'super-user')->get();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone_number' => 'required|unique:users',
            'end_date' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_number' => $request->phone_number,
            'end_date' => $request->end_date,
        ]);

        $user->assignRole('show-grammar-lessons');

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        $roles = Role::where('name', '!=', 'super-user')->orderBy('created_at')->get();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:255',
            'end_date' => 'required',
            'role_id' => 'required|integer|exists:roles,id'
        ]);

        $user->update([
            'name' => $request->name,
            'end_date' => $request->end_date
        ]);
        $role = Role::find($request->role_id);

        $user->syncRoles([$role->name]);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
