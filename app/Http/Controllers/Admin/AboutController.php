<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAboutRequest;
use App\Models\About;
use App\Services\DOMDocumentService;
use App\Services\UploadFileService;
use Illuminate\Support\Facades\Storage;


class AboutController extends Controller
{
    public function index()
    {
        $abouts = About::all();
        return view('admin.about.index', compact('abouts'));
    }

    public function show(About $about)
    {
        return view('admin.about.show', compact('about'));
    }

    public function edit(About $about)
    {
        return view('admin.about.edit', compact('about'));
    }

    public function update(UpdateAboutRequest $request, About $about, DOMDocumentService $docService)
    {
        $validatedData = $request->validated();

        $description = $request->desc;
        $processedDesc = $docService->processHTML($description);

        if ($request->hasFile('video')) {
            if ($about->video && Storage::disk('public')->exists($about->video)) {
                UploadFileService::deleteFile($about->video);
            }
            $validatedData['video'] = UploadFileService::uploadFile($request->file('video'), 'videos');
        }

        $validatedData['desc'] = $processedDesc;

        $about->update($validatedData);

        return redirect()->route('abouts.index')->with('success', 'About updated successfully!');
    }

    public function destroy(About $about, DOMDocumentService $docService)
    {
        try {
            $about = About::find($about->id);

            if (!$about) {
                return redirect()->route('abouts.index')->with('error', 'About not found.');
            }

            if (!empty($about->desc)) {
                $docService->delete($about->desc);
            }

            if ($about->video) {
                UploadFileService::deleteFile($about->video);
            }

            $about->delete();

            return redirect()->route('abouts.index')->with('success', 'About deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('abouts.index')->with('error', 'Error deleting about: ' . $e->getMessage());
        }
    }

}
