<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAboutRequest;
use App\Http\Requests\UpdateAboutRequest;
use App\Models\About;
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

    public function store(StoreAboutRequest $request)
    {
        $validatedData = $request->validated();

        $description = $request->desc;
        $dom = new DOMDocument();
        $dom->loadHTML($description, 9);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
            $image_name = "/storage/images" . time() . $key . '.jpeg,jpg,png,gif,webp,max:10000';
            file_put_contents(public_path($image_name), $data);

            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $description = $dom->saveHTML();

        About::create([
            'desc' => $description,
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

    public function update(UpdateAboutRequest $request, About $about)
    {
        $validatedData = $request->validated();

        $description = $request->desc;
        $dom = new DOMDocument();
        $dom->loadHTML($description, 9);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {

            if (strpos($img->getAttribute('src'), 'data:image/') ===0) {
                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                $image_name = "/storage/images" . time() . $key . '.jpeg,jpg,png,gif,webp,max:10000';
                file_put_contents(public_path($image_name), $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }
        $description = $dom->saveHTML();

        $about->update([
            'desc' => $description,
            'address' => $request->address,
            'telegram_account' => $request->telegram_account,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('abouts.index')->with('success', 'About updated successfully!');
    }

    public function destroy(About $about)
    {
        try {
            $about = About::find($about->id);

            if (!$about) {
                return redirect()->route('abouts.index')->with('error', 'About not found.');
            }

            $dom = new DOMDocument();
            $dom->loadHTML($about->desc, 9);
            $images = $dom->getElementsByTagName('img');

            foreach ($images as $img) {
                $path = public_path($img->getAttribute('src'));

                if (File::exists($path)) {
                    File::delete($path);
                }
            }

            $about->delete();

            return redirect()->route('abouts.index')->with('success', 'About deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('abouts.index')->with('error', 'Error deleting about: ' . $e->getMessage());
        }
    }

}
