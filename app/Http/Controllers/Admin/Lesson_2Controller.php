<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store_Lesson_Request;
use App\Http\Requests\Update_Lesson_Request;
use App\Models\Lesson_2;
use Carbon\Carbon;
use DOMDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Lesson_2Controller extends Controller
{
    public function index()
    {
        if (Auth::user()->end_date > Carbon::now()) {
            $lessons = Lesson_2::all();

            return view('admin.grammar-lesson-2.index', compact('lessons'));
        } else {
            return view('admin.error');
        }
    }

    public function store(Store_Lesson_Request $request)
    {
        try {
            $validatedData = $request->validated();

            $homework = $request->homework;
            $dom = new DOMDocument();
            $dom->loadHTML($homework, 9);

            $images = $dom->getElementsByTagName('img');

            foreach ($images as $key => $img) {
                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                $image_name = "/storage/images" . time() . $key . '.jpeg,jpg,png,gif,webp';
                file_put_contents(public_path($image_name), $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }

            $homework = $dom->saveHTML();

            $answer = $request->answer;
            $dom = new DOMDocument();
            $dom->loadHTML($answer, 9);

            $images = $dom->getElementsByTagName('img');

            foreach ($images as $key => $img) {
                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                $image_name = "/storage/images" . time() . $key . '.jpeg,jpg,png,gif,webp';
                file_put_contents(public_path($image_name), $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }

            $answer = $dom->saveHTML();

            $VideoPath = $request->file('video')->store('videos', 'public');
            $ImagePath = $request->file('image')->store('images', 'public');
            $VoicePath = $request->file('voice')->store('voices', 'public');
            $PdfPath = $request->file('pdf')->store('files', 'public');

            Lesson_2::create([
                'name_video' => $validatedData['name_video'],
                'video' => $VideoPath,
                'name_image' => $validatedData['name_image'],
                'image' => $ImagePath,
                'voice' => $VoicePath,
                'pdf' => $PdfPath,
                'homework' => $homework,
                'answer' => $answer,
            ]);

            return redirect()->route('lesson-2.index')->with('success', 'Lesson created successfully!');
        } catch (\Exception $e) {
            // Handle errors
            return redirect()->back()->with('error', 'Error creating lesson: ' . $e->getMessage());
        }
    }

    public function edit(Lesson_2 $lesson_2)
    {
        return view('admin.grammar-lesson-2.edit', compact('lesson_2'));
    }

    public function update(Update_Lesson_Request $request, Lesson_2 $lesson_2)
    {
        try {
            $validatedData = $request->validated();

            // Обработка домашнего задания (homework)
            $homework = $validatedData['homework'];
            $dom = new DOMDocument();
            $dom->loadHTML($homework, 9);

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

            $homework = $dom->saveHTML();
            $validatedData['homework'] = $homework;

            // Обработка ответа (answer)
            $answer = $validatedData['answer'];
            $dom = new DOMDocument();
            $dom->loadHTML($answer, 9);

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

            $answer = $dom->saveHTML();
            $validatedData['answer'] = $answer;

            if ($request->hasFile('video')) {
                $newVideo = $request->file('video')->store('videos', 'public');
                if ($lesson_2->video && Storage::disk('public')->exists($lesson_2->video)) {
                    Storage::disk('public')->delete($lesson_2->video);
                }
                $validatedData['video'] = $newVideo;
            }

            if ($request->hasFile('pdf')) {
                $newPdf = $request->file('pdf')->store('files', 'public');
                if ($lesson_2->pdf && Storage::disk('public')->exists($lesson_2->pdf)) {
                    Storage::disk('public')->delete($lesson_2->pdf);
                }
                $validatedData['pdf'] = $newPdf;
            }

            if ($request->hasFile('image')) {
                $newImage = $request->file('image')->store('images', 'public');
                if ($lesson_2->image && Storage::disk('public')->exists($lesson_2->image)) {
                    Storage::disk('public')->delete($lesson_2->image);
                }
                $validatedData['image'] = $newImage;
            }

            if ($request->hasFile('voice')) {
                $newVoice = $request->file('voice')->store('voices', 'public');
                if ($lesson_2->voice && Storage::disk('public')->exists($lesson_2->voice)) {
                    Storage::disk('public')->delete($lesson_2->voice);
                }
                $validatedData['voice'] = $newVoice;
            }

            // Обновление данных модели
            $lesson_2->update($validatedData);

            return redirect()->route('lesson-2.index')->with('success', 'Lesson updated successfully!');
        } catch (\Exception $e) {
            // Обработка ошибок
            return redirect()->back()->with('error', 'Error updating lesson: ' . $e->getMessage());
        }
    }

    public function delete(Lesson_2 $lesson_2)
    {
        try {
            $lesson_2 = Lesson_2::find($lesson_2->id);

            if (!$lesson_2) {
                return redirect()->route('lesson-2.index')->with('error', 'Lesson not found.');
            }

            // Проверка наличия и непустоты поля desc
            if (!empty($lesson_2->desc)) {
                $dom = new DOMDocument();
                $dom->loadHTML($lesson_2->desc, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                $images = $dom->getElementsByTagName('img');

                foreach ($images as $img) {
                    $path = public_path($img->getAttribute('src'));

                    if (File::exists($path)) {
                        File::delete($path);
                    }
                }
            }

            if ($lesson_2->video && Storage::disk('public')->exists($lesson_2->video)) {
                Storage::disk('public')->delete($lesson_2->video);
            }

            if ($lesson_2->image && Storage::disk('public')->exists($lesson_2->image)) {
                Storage::disk('public')->delete($lesson_2->image);
            }

            if ($lesson_2->voice && Storage::disk('public')->exists($lesson_2->voice)) {
                Storage::disk('public')->delete($lesson_2->voice);
            }

            if ($lesson_2->pdf && Storage::disk('public')->exists($lesson_2->pdf)) {
                Storage::disk('public')->delete($lesson_2->pdf);
            }

            $lesson_2->delete();

            return redirect()->route('lesson-2.index')->with('success', 'Lesson deleted successfully!');
        } catch (\Exception $e) {
            if ($lesson_2->exists) {
                Log::error('Error deleting files for lesson ' . $lesson_2->id . ': ' . $e->getMessage());
            }

            return redirect()->back()->with('error', 'Error deleting lesson: ' . $e->getMessage());
        }
    }
}
