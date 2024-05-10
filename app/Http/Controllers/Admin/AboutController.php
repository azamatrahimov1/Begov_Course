<?php

namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAboutRequest;
use App\Http\Requests\UpdateAboutRequest;
use App\Models\About;
use App\Services\DOMDocumentService;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


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

    public function create()
    {
        return view('admin.about.create');
    }

    public function store(StoreAboutRequest $request, DOMDocumentService $docService)
    {
        $validatedData = $request->validated();

        $description = $request->desc;
        $processedDesc = $docService->processHTML($description);

        About::create([
            'desc' => $processedDesc,
            'address' => $validatedData['address'],
            'telegram_account' => $validatedData['telegram_account'],
            'phone_number' => $validatedData['phone_number'],
        ]);

        return redirect()->route('abouts.index')->with('success', 'About created successfully!');
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

        $about->update([
            'desc' => $$processedDesc,
            'address' => $request->address,
            'telegram_account' => $request->telegram_account,
            'phone_number' => $request->phone_number,
        ]);

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

            $about->delete();

            return redirect()->route('abouts.index')->with('success', 'About deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('abouts.index')->with('error', 'Error deleting about: ' . $e->getMessage());
        }
    }

}
