<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Models\Lesson;
use App\Models\Like;
use Carbon\Carbon;
use DOMDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    public function index()
    {
        if (Auth::user()->end_date > Carbon::now()) {
            $lessons = Lesson::paginate(10);

            return view('admin.grammar-lessons.index', compact('lessons'));
        } else {
            return view('admin.error');
        }
    }

    public function store(StoreLessonRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $homework = $request->homework;
            $dom = new DOMDocument();
            $dom->loadHTML($homework, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

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
            $dom->loadHTML($answer, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

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

            Lesson::create([
                'name' => $validatedData['name'],
                'name_video' => $validatedData['name_video'],
                'video' => $VideoPath,
                'name_image' => $validatedData['name_image'],
                'image' => $ImagePath,
                'voice' => $VoicePath,
                'pdf' => $PdfPath,
                'homework' => $homework,
                'answer' => $answer,
            ]);

            return redirect()->route('lessons.index')->with('success', 'Lesson created successfully!');
        } catch (\Exception $e) {
            // Handle errors
            return redirect()->back()->with('error', 'Error creating lesson: ' . $e->getMessage());
        }
    }

    public function show(Lesson $lesson)
    {
        return view('admin.grammar-lessons.show', compact('lesson'));
    }

    public function edit(Lesson $lesson)
    {
        return view('admin.grammar-lessons.edit', compact('lesson'));
    }

    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        try {
            $validatedData = $request->validated();

            $homework = $validatedData['homework'];
            $dom = new DOMDocument();
            $dom->loadHTML($homework, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

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
            $dom->loadHTML($answer, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

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
                if ($lesson->video && Storage::disk('public')->exists($lesson->video)) {
                    Storage::disk('public')->delete($lesson->video);
                }
                $validatedData['video'] = $newVideo;
            }

            if ($request->hasFile('pdf')) {
                $newPdf = $request->file('pdf')->store('files', 'public');
                if ($lesson->pdf && Storage::disk('public')->exists($lesson->pdf)) {
                    Storage::disk('public')->delete($lesson->pdf);
                }
                $validatedData['pdf'] = $newPdf;
            }



            if ($request->hasFile('image')) {
                $newImage = $request->file('image')->store('images', 'public');
                if ($lesson->image && Storage::disk('public')->exists($lesson->image)) {
                    Storage::disk('public')->delete($lesson->image);
                }
                $validatedData['image'] = $newImage;
            }

            if ($request->hasFile('voice')) {
                $newVoice = $request->file('voice')->store('voices', 'public');
                if ($lesson->voice && Storage::disk('public')->exists($lesson->voice)) {
                    Storage::disk('public')->delete($lesson->voice);
                }
                $validatedData['voice'] = $newVoice;
            }

            // Обновление данных модели
            $lesson->update($validatedData);

            return redirect()->route('lessons.index')->with('success', 'Lesson updated successfully!');
        } catch (\Exception $e) {
            // Обработка ошибок
            return redirect()->back()->with('error', 'Error updating lesson: ' . $e->getMessage());
        }
    }

    public function destroy(Lesson $lesson)
    {
        try {
            $lesson = Lesson::find($lesson->id);

            if (!$lesson) {
                return redirect()->route('lessons.index')->with('error', 'Lesson not found.');
            }

            // Проверка наличия и непустоты поля desc
            if (!empty($lesson->desc)) {
                $dom = new DOMDocument();
                $dom->loadHTML($lesson->desc, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                $images = $dom->getElementsByTagName('img');

                foreach ($images as $img) {
                    $path = public_path($img->getAttribute('src'));

                    if (File::exists($path)) {
                        File::delete($path);
                    }
                }
            }

            if ($lesson->video && Storage::disk('public')->exists($lesson->video)) {
                Storage::disk('public')->delete($lesson->video);
            }

            if ($lesson->image && Storage::disk('public')->exists($lesson->image)) {
                Storage::disk('public')->delete($lesson->image);
            }

            if ($lesson->voice && Storage::disk('public')->exists($lesson->voice)) {
                Storage::disk('public')->delete($lesson->voice);
            }

            if ($lesson->pdf && Storage::disk('public')->exists($lesson->pdf)) {
                Storage::disk('public')->delete($lesson->pdf);
            }

            $lesson->delete();

            return redirect()->route('lessons.index')->with('success', 'Lesson deleted successfully!');
        } catch (\Exception $e) {
            if ($lesson->exists) {
                Log::error('Error deleting files for lesson ' . $lesson->id . ': ' . $e->getMessage());
            }

            return redirect()->back()->with('error', 'Error deleting lesson: ' . $e->getMessage());
        }
    }

    public function like(Lesson $lesson)
    {
        $liker = auth()->user();

        $liker->likes()->attach($lesson);

        return redirect()->route('lessons.index');
    }

    public function unlike(Lesson $lesson)
    {
        $liker = auth()->user();

        $liker->likes()->detach($lesson);

        return redirect()->route('lessons.index');
    }
}
