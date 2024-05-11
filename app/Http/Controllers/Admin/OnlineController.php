<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeOfLessonRequest;
use App\Http\Requests\UpdateTypeOfLessonRequest;
use App\Models\Online;
use App\Services\DOMDocumentService;
use App\Services\UploadFileService;
use DOMDocument;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class OnlineController extends Controller
{
    public function index()
    {
        $onlines = Online::all();

        return view('admin.online.index', compact('onlines'));
    }

    public function store(StoreTypeOfLessonRequest $request, DOMDocumentService $docService)
    {
        try {
            $validatedData = $request->validated();

            $desc = $request->desc;
            $processedDesc = $docService->processHTML($desc);

            $validatedData['desc'] = $processedDesc;

            $ImagePath = UploadFileService::uploadFile($request->file('image'), 'images');

            Online::create([
                'title' => $validatedData['title'],
                'image' => $ImagePath,
                'desc' => $processedDesc,
            ]);

            return redirect()->route('online.index')->with('success', 'Online lesson created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating Online lesson: ' . $e->getMessage());
        }
    }

    public function edit(Online $online)
    {
        return view('admin.online.edit', compact('online'));
    }

    public function update(UpdateTypeOfLessonRequest $request, Online $online, DOMDocumentService $docService)
    {
        try {
            $validatedData = $request->validated();

            $desc = $validatedData['desc'];
            $processedDesc = $docService->processHTML($desc);

            $validatedData['desc'] = $processedDesc;

            if ($request->hasFile('image')) {
                if ($online->image && Storage::disk('public')->exists($online->image)) {
                    UploadFileService::deleteFile($online->image);
                }
                $validatedData['image'] = UploadFileService::uploadFile($request->file('image'), 'images');
            }

            $online->update($validatedData);

            return redirect()->route('online.index')->with('success', 'Online lesson updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating Online lesson: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Error updating Main Screen. Please check the logs for details.');
        }
    }

    public function destroy(Online $online, DOMDocumentService $docService)
    {
        try {
            if (!$online->exists) {
                return redirect()->route('online.index')->with('error', 'Online lesson not found.');
            }

            if (!empty($lesson->desc)) {
                $docService->delete($lesson->desc);
            }

            if ($online->image) {
                UploadFileService::deleteFile($online->image);
            }

            $online->delete();

            return redirect()->route('online.index')->with('success', 'Online lesson deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting online lesson: ' . $e->getMessage());
        }
    }

}
