<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeOfLessonRequest;
use App\Http\Requests\UpdateTypeOfLessonRequest;
use App\Models\Online;
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

    public function store(StoreTypeOfLessonRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $desc = $request->desc;
            $dom = new DOMDocument();
            $dom->loadHTML($desc, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            $images = $dom->getElementsByTagName('img');

            foreach ($images as $key => $img) {
                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                $image_name = "/storage/images" . time() . $key . '.jpeg,jpg,png,gif,webp';
                file_put_contents(public_path($image_name), $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }

            $desc = $dom->saveHTML();

            $ImagePath = $request->file('image')->store('images', 'public');

            Online::create([
                'title' => $validatedData['title'],
                'image' => $ImagePath,
                'desc' => $desc,
            ]);

            return redirect()->route('online.index')->with('success', 'Online lesson created successfully!');
        } catch (\Exception $e) {
            // Handle errors
            return redirect()->back()->with('error', 'Error creating Online lesson: ' . $e->getMessage());
        }
    }

    public function edit(Online $online)
    {
        return view('admin.online.edit', compact('online'));
    }

    public function update(UpdateTypeOfLessonRequest $request, Online $online)
    {
        try {
            $validatedData = $request->validated();

            $desc = $validatedData['desc'];
            $dom = new DOMDocument();
            $dom->loadHTML($desc, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            $images = $dom->getElementsByTagName('img');

            foreach ($images as $key => $img) {
                if (strpos($img->getAttribute('src'), 'data:image/') === 0) {
                    $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                    $image_name = "/storage/images/" . time() . $key . '.jpeg';
                    file_put_contents(public_path($image_name), $data);

                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                }
            }

            $desc = $dom->saveHTML();
            $validatedData['desc'] = $desc;

            if ($request->hasFile('image')) {
                $newImage = $request->file('image')->store('images', 'public');
                if ($online->image && Storage::disk('public')->exists($online->image)) {
                    Storage::disk('public')->delete($online->image);
                }
                $validatedData['image'] = $newImage;
            }

            // Обновление данных модели
            $online->update($validatedData);

            return redirect()->route('online.index')->with('success', 'Online lesson updated successfully!');
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error updating Online lesson: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Error updating Main Screen. Please check the logs for details.');
        }
    }

    public function destroy(Online $online)
    {
        try {
            if (!$online->exists) {
                return redirect()->route('online.index')->with('error', 'Online lesson not found.');
            }

            // Удаление изображений в описании
            if (!empty($online->desc)) {
                // ... (ваш код для удаления изображений из описания)
            }

            if ($online->image && Storage::disk('public')->exists($online->image)) {
                Storage::disk('public')->delete($online->image);
            }

            $online->delete();

            return redirect()->route('online.index')->with('success', 'Online lesson deleted successfully!');
        } catch (\Exception $e) {
            // Обработка ошибок
            return redirect()->back()->with('error', 'Error deleting online lesson: ' . $e->getMessage());
        }
    }

}
