<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use App\Services\UploadFileService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::all();

        return view('admin.gallery.index', compact('galleries'));
    }

    public function store(StoreGalleryRequest $request)
    {
        try {
            $validatedData = $request->validated();

            if ($request->hasFile('image')) {
                $filename = UploadFileService::uploadFile($request->file('image'), 'images');
                $validatedData['image'] = $filename;
            }

            Gallery::create([
                'title' => $validatedData['title'],
                'image' => $filename
            ]);

            return redirect()->route('gallery.index')->with('success', 'Gallery created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating Gallery: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all(),
            ]);

            return redirect()->back()->with('error', 'Error creating Gallery: ' . $e->getMessage());
        }
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        try {
            $validatedData = $request->validated();

            if ($request->hasFile('image')) {
                if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                    UploadFileService::deleteFile($gallery->image);
                }
                $validatedData['image'] = UploadFileService::uploadFile($request->file('image'), 'images');
                $validatedData['title'] = $request->title;
            }

            $gallery->update($validatedData);

            return redirect()->route('gallery.index')->with('success', 'Gallery updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating Gallery: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Error updating Gallery. Please check the logs for details.');
        }
    }

    public function destroy(Gallery $gallery)
    {
        try {

            if ($gallery->image) {
                UploadFileService::deleteFile($gallery->image);
            }

            $gallery->delete();

            return redirect()->route('gallery.index')->with('success', 'Gallery deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting Gallery: ' . $e->getMessage());
        }
    }

}
