<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateLogoRequest;
use App\Models\Logo;
use App\Services\UploadFileService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{
    public function index()
    {
        $logos = Logo::all();

        return view('admin.logo.index', compact('logos'));
    }

    public function edit(Logo $logo)
    {
        return view('admin.logo.edit', compact('logo'));
    }

    public function update(UpdateLogoRequest $request, Logo $logo)
    {
        try {
            $validatedData = $request->validated();

            if ($request->hasFile('image')) {
                if ($logo->image && Storage::disk('public')->exists($logo->image)) {
                    UploadFileService::deleteFile($logo->image);
                }
                $validatedData['image'] = UploadFileService::uploadFile($request->file('image'), 'images');
                $validatedData['title'] = $request->title;
            }

            $logo->update($validatedData);

            return redirect()->route('logo.index')->with('success', 'Logo updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating Logo: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Error updating Logo. Please check the logs for details.');
        }
    }

    public function destroy(Logo $logo)
    {
        try {

            if ($logo->image) {
                UploadFileService::deleteFile($logo->image);
            }

            $logo->delete();

            return redirect()->route('logo.index')->with('success', 'Logo deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting Logo: ' . $e->getMessage());
        }
    }
}
