<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMainScreenRequest;
use App\Http\Requests\UpdateMainScreenRequest;
use App\Models\MainScreen;
use App\Services\UploadFileService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class MainScreenController extends Controller
{
    public function index()
    {
        $mainScreens = MainScreen::all();

        return view('admin.MainScreen.index', compact('mainScreens'));
    }

    public function store(StoreMainScreenRequest $request)
    {
        try {
            $data = new MainScreen();

            if ($request->hasFile('image')) {
                $filename = UploadFileService::uploadFile($request->file('image'), 'images');

                $data->fill([
                    'title' => $request->title,
                    'image' => $filename,
                ])->save();
            }

            return redirect()->route('main-screen.index')->with('success', 'Main Screen created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating Main Screen: ' . $e->getMessage());
        }
    }

    public function edit(MainScreen $mainScreen)
    {
        return view('admin.MainScreen.edit', compact('mainScreen'));
    }

    public function update(UpdateMainScreenRequest $request, MainScreen $mainScreen)
    {
        try {
            $validatedData = $request->validated();

            if ($request->hasFile('image')) {
                if ($mainScreen->image && Storage::disk('public')->exists($mainScreen->image)) {
                    UploadFileService::deleteFile($mainScreen->image);
                }
                $validatedData['image'] = UploadFileService::uploadFile($request->file('image'), 'images');
                $validatedData['title'] = $request->title;
            }

            $mainScreen->update($validatedData);

            return redirect()->route('main-screen.index')->with('success', 'Main Screen updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating Main Screen: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Error updating Main Screen. Please check the logs for details.');
        }
    }

    public function destroy(MainScreen $mainScreen)
    {
        try {

            if ($mainScreen->image) {
                UploadFileService::deleteFile($mainScreen->image);
            }

            $mainScreen->delete();

            return redirect()->route('main-screen.index')->with('success', 'Main Screen deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting Main Screen: ' . $e->getMessage());
        }
    }

}
