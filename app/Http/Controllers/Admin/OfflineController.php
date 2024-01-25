<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeOfLessonRequest;
use App\Http\Requests\UpdateTypeOfLessonRequest;
use App\Models\Offline;
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

            Offline::create([
                'title' => $validatedData['title'],
                'image' => $ImagePath,
                'desc' => $desc,
            ]);

            return redirect()->route('offline.index')->with('success', 'Offline lesson created successfully!');
        } catch (\Exception $e) {
            // Handle errors
            return redirect()->back()->with('error', 'Error creating offline lesson: ' . $e->getMessage());
        }
    }

    public function edit(Offline $offline)
    {
        return view('admin.offline.edit', compact('offline'));
    }

    public function update(UpdateTypeOfLessonRequest $request, Offline $offline)
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
                if ($offline->image && Storage::disk('public')->exists($offline->image)) {
                    Storage::disk('public')->delete($offline->image);
                }
                $validatedData['image'] = $newImage;
            }

            // Обновление данных модели
            $offline->update($validatedData);

            return redirect()->route('offline.index')->with('success', 'Offline lesson updated successfully!');
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error updating Offline lesson: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Error updating offline lesson. Please check the logs for details.');
        }
    }

    public function destroy(Offline $offline)
    {
        try {
            if (!$offline->exists) {
                return redirect()->route('online.index')->with('error', 'Offline lesson not found.');
            }

            // Удаление изображений в описании
            if (!empty($offline->desc)) {
                // ... (ваш код для удаления изображений из описания)
            }

            if ($offline->image && Storage::disk('public')->exists($offline->image)) {
                Storage::disk('public')->delete($offline->image);
            }

            $offline->delete();

            return redirect()->route('offline.index')->with('success', 'Offline lesson deleted successfully!');
        } catch (\Exception $e) {
            // Обработка ошибок
            return redirect()->back()->with('error', 'Error deleting offline lesson: ' . $e->getMessage());
        }
    }
}
