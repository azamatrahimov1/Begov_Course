<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChapterRequest;
use App\Http\Requests\UpdateChapterRequest;
use App\Models\Chapter;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class ChapterController extends Controller
{
    public function index()
    {
        if (Auth::user()->end_date > Carbon::now()) {
            $chapters = Chapter::query()
                ->when(request('search'), function ($query) {
                    $query->where('name', 'LIKE', '%' . request('search') . '%')
                        ->orWhere('parent_id', 'LIKE', '%' . request('search') . '%');
                })
                ->paginate(10);

            return view('admin.chapters.index', compact('chapters'));
        } else {
            return view('admin.error');
        }
    }


    public function create()
    {
        return view('admin.chapters.create');
    }

    public function store(StoreChapterRequest $request)
    {
        Chapter::create($request->all());

        return redirect()->route('chapters.index')->with('success', 'Chapter created successfully!');
    }

    public function edit(Chapter $chapter)
    {
        return view('admin.chapters.edit', compact('chapter'));
    }

    public function update(UpdateChapterRequest $request, Chapter $chapter)
    {

        $chapter->update($request->all());

        return redirect()->route('chapters.index')->with('success', 'Chapter updated successfully!');
    }

    public function destroy(Chapter $chapter)
    {
        $chapter->delete();

        return redirect()->route('chapters.index')->with('success', 'Chapter deleted successfully!');
    }
}
