<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeOfLessonRequest;
use App\Http\Requests\UpdateTypeOfLessonRequest;
use App\Models\Offline;
use App\Services\DOMDocumentService;
use App\Services\UploadFileService;
use DOMDocument;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class OfflineController extends Controller
{
    public function index()
    {
        $offlines = Offline::all();

        return view('admin.offline.index', compact('offlines'));
    }

    public function store(StoreTypeOfLessonRequest $request, DOMDocumentService $docService)
    {
        try {
            $validatedData = $request->validated();

            $desc = $request->desc;
            $processedDesc = $docService->processHTML($desc);

            $ImagePath = UploadFileService::uploadFile($request->file('image'), 'images');

            Offline::create([
                'title' => $validatedData['title'],
                'image' => $ImagePath,
                'desc' => $processedDesc,
            ]);

            return redirect()->route('offline.index')->with('success', 'Offline lesson created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating offline lesson: ' . $e->getMessage());
        }
    }

    public function edit(Offline $offline)
    {
        return view('admin.offline.edit', compact('offline'));
    }

    public function update(UpdateTypeOfLessonRequest $request, Offline $offline, DOMDocumentService $docService)
    {
        try {
            $validatedData = $request->validated();

            $desc = $validatedData['desc'];
            $processedDesc = $docService->processHTML($desc);

            $validatedData['desc'] = $processedDesc;

            if ($request->hasFile('image')) {
                if ($offline->image && Storage::disk('public')->exists($offline->image)) {
                    UploadFileService::deleteFile($offline->image);
                }
                $validatedData['image'] = UploadFileService::uploadFile($request->file('image'), 'images');
            }

            $offline->update($validatedData);

            return redirect()->route('offline.index')->with('success', 'Offline lesson updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating Offline lesson: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Error updating offline lesson. Please check the logs for details.');
        }
    }

    public function destroy(Offline $offline, DOMDocumentService $docService)
    {
        try {
            if (!$offline->exists) {
                return redirect()->route('online.index')->with('error', 'Offline lesson not found.');
            }

            if (!empty($lesson->desc)) {
                $docService->delete($lesson->desc);
            }

            if ($offline->image) {
                UploadFileService::deleteFile($offline->image);
            }

            $offline->delete();

            return redirect()->route('offline.index')->with('success', 'Offline lesson deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting offline lesson: ' . $e->getMessage());
        }
    }
}
