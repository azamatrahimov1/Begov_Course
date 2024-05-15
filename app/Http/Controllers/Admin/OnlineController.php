<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOnlineRequest;
use App\Http\Requests\UpdateOnlineRequest;
use App\Models\Online;
use App\Services\DOMDocumentService;
use App\Services\UploadFileService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class OnlineController extends Controller
{
    public function index()
    {
        $onlines = Online::all();

        return view('admin.online.index', compact('onlines'));
    }

    public function store(StoreOnlineRequest $request, DOMDocumentService $docService)
    {
        try {
            $validatedData = $request->validated();

            $desc = $request->desc;
            $processedDesc = $docService->processHTML($desc);

            $validatedData['desc'] = $processedDesc;

            $ImagePath = UploadFileService::uploadFile($request->file('image'), 'images');

            $price = (int) str_replace('.',',', '', $request->price);

            Online::create([
                'title' => $validatedData['title'],
                'price' => $price,
                'image' => $ImagePath,
                'desc' => $processedDesc,
            ]);

            return redirect()->route('online.index')->with('success', 'Online lesson created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating online lesson: ' . $e->getMessage());
        }
    }

    public function edit(Online $online)
    {
        return view('admin.online.edit', compact('online'));
    }

    public function update(UpdateOnlineRequest $request, Online $online, DOMDocumentService $docService)
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

            $price = (int) str_replace('.', '', $request->price);
            $validatedData['price'] = $price;

            $online->update($validatedData);

            return redirect()->route('online.index')->with('success', 'Online lesson updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating online lesson: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Error updating online lesson. Please check the logs for details.');
        }
    }

    public function destroy(Online $online, DOMDocumentService $docService)
    {
        try {
            if (!$online->exists) {
                return redirect()->route('online.index')->with('error', 'Online lesson not found.');
            }

            if (!empty($online->desc)) {
                $docService->delete($online->desc);
            }

            if ($online->image) {
                UploadFileService::deleteFile($online->image);
            }

            $online->delete();

            return redirect()->route('ofline.index')->with('success', 'Online lesson deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting online lesson: ' . $e->getMessage());
        }
    }

}
