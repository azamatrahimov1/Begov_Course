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

}
