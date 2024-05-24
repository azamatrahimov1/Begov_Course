<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request, $id): View
    {
        $order = new Order();
        $order->course_id = $id;
        $order->price = $request->amount;
        $order->save();

        if ($order->save()) {
            return view('auth.register', compact('order'));
        } else {
            return redirect()->back()->with('error', 'Buyurtma yaratib bo‘lmadi');
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request)
    {
        $data = $request->validated();

        // Проверка, есть ли заказы с пустой ценой
        if (Order::whereNull('price')->exists()) {
            return redirect()->back()->with('error', 'Xatolik yuz berdi');
        }

        // Создание нового пользователя
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'],
            'end_date' => Carbon::now()->addDays(62),
            'transaction_id' => null,
            'transaction_state' => null,
        ]);

        event(new Registered($user));

        return view('auth.checkout', compact('user'));
    }


    public function checkout(Request $request, User $user, Transaction $transaction)
    {
        $validatedData = $request->validate([
            'paycom_transaction_id' => 'required|string',
            'state' => 'required|integer',
        ]);

        if ($validatedData['paycom_transaction_id'] == $transaction->paycom_transaction_id && $validatedData['state'] == $transaction->state) {
            $user->transaction_id = $transaction->id;
            $user->transaction_state = $transaction->state;
            $user->save();

            $user->assignRole('show-grammar-lessons');
            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);
        } else {
            return redirect()->back()->with('error', 'Ошибка при проведении платежа');
        }
    }
}
