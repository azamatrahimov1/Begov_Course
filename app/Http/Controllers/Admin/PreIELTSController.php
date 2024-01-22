<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePreIELTSRequest;
use App\Http\Requests\UpdatePreIELTSRequest;
use App\Models\PreIELTS;
use Carbon\Carbon;
use DOMDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PreIELTSController extends Controller
{
    public function index()
    {
        if (Auth::user()->end_date > Carbon::now()) {
            $preIELTSs = PreIELTS::query()
                ->when(request('search'), function ($query) {
                    $query->where('name', 'LIKE', '%' . request('search') . '%');
                })
                ->paginate(8);

            return view('admin.pre-IELTS.index', compact('preIELTSs'));
        } else {
            return view('admin.error');
        }
    }

    public function create()
    {
        return view('admin.pre-IELTS.create');
    }

    public function store(StorePreIELTSRequest $request)
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

        PreIELTS::create([
            'name' => $validatedData['name'],
            'desc' => $description,
        ]);

        return redirect()->route('pre-IELTS.index')->with('success', 'PreIELTS created successfully!');
    }


    public function show($id)
    {
        $preIELTS = PreIELTS::find($id);

        return view('admin.pre-IELTS.show', compact('preIELTS'));
    }

    public function edit(PreIELTS $pre_IELT)
    {
        return view('admin.pre-IELTS.edit', compact('pre_IELT'));
    }

    public function update(UpdatePreIELTSRequest $request, PreIELTS $pre_IELT)
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

        $pre_IELT->update([
            'name' => $request->name,
            'desc' => $description
        ]);

        return redirect()->route('pre-IELTS.index')->with('success', 'PreIELTS updated successfully!');
    }

    public function destroy($id)
    {
        $pre_IELT = PreIELTS::find($id);

        if (!$pre_IELT) {
            return redirect()->route('pre-IELTS.index')->with('error', 'PreIELTS not found!');
        }

        $dom = new DOMDocument();
        $dom->loadHTML($pre_IELT->desc, 9);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $path = public_path($img->getAttribute('src'));

            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $pre_IELT->delete();

        return redirect()->back()->with('success', 'PreIELTS deleted successfully!');
    }
}
