<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMainScreenRequest;
use App\Http\Requests\UpdateMainScreenRequest;
use App\Models\MainScreen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainScreenController extends Controller
{
    public function index()
    {
        $mainScreens = MainScreen::all();

        return view('admin.MainScreen.index', compact('mainScreens'));
    }

    public function create()
    {
        return view('admin.MainScreen.create');
    }

    public function store(StoreMainScreenRequest $request)
    {
        try {
            $data = new MainScreen();

            if ($request->hasFile('image')) {
                $file = $request->file('image');

                // Store the file in the public storage folder
                $filename = $file->store('images', 'public');

                $data->fill([
                    'title' => $request->title,
                    'image' => $filename,
                ])->save();
            }

            return redirect()->route('main-screen.index')->with('success', 'Main Screen created successfully!');
        } catch (\Exception $e) {
            // Handle errors
            return redirect()->back()->with('error', 'Error creating Main Screen: ' . $e->getMessage());
        }
    }

    public function edit(MainScreen $mainScreen)
    {
        // Нет необходимости повторно извлекать модель
        return view('admin.MainScreen.edit', compact('mainScreen'));
    }

    public function update(UpdateMainScreenRequest $request, MainScreen $mainScreen)
    {
        try {
            $validatedData = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $filename = $request->file('thumbnail')->store('admin.photos', 'public');

                if ($mainScreen->image) {
                    Storage::disk('public')->delete($mainScreen->image);
                }

                $validatedData['image'] = $filename;
            }

            $mainScreen->update($validatedData);

            return redirect()->route('main-screen.index')->with('success', 'Main Screen updated successfully!');
        } catch (\Exception $e) {
            // Handle errors
            return redirect()->back()->with('error', 'Error updating Main Screen: ' . $e->getMessage());
        }
    }

    public function destroy(MainScreen $mainScreen)
    {
        try {

            if ($mainScreen->image) {
                Storage::disk('public')->delete($mainScreen->image);
            }

            // Delete the MainScreen record from the database
            $mainScreen->delete();

            return redirect()->route('main-screen.index')->with('success', 'Main Screen deleted successfully!');
        } catch (\Exception $e) {
            // Handle errors
            return redirect()->back()->with('error', 'Error deleting Main Screen: ' . $e->getMessage());
        }
    }

}
