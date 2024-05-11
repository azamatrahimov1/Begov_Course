<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Models\Lesson;
use App\Models\Photo;
use App\Services\DOMDocumentService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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

    public function store(StoreLessonRequest $request, DOMDocumentService $docService)
    {
        try {
            $validatedData = $request->validated();

            $processedHomework = $docService->processHTML($request->homework);
            $processedAnswer = $docService->processHTML($request->answer);

            $videoPath = $request->file('video')->store('videos', 'public');
            $voicePath = $request->file('voice')->store('voices', 'public');
            $pdfPath = $request->file('pdf')->store('files', 'public');

            $lesson = Lesson::create([
                'name' => $validatedData['name'],
                'name_video' => $validatedData['name_video'],
                'video' => $videoPath,
                'name_image' => $validatedData['name_image'],
                'voice' => $voicePath,
                'pdf' => $pdfPath,
                'homework' => $processedHomework,
                'answer' => $processedAnswer,
            ]);

            if ($request->hasFile('photos')) {
                $photos = $this->storePhotos($request->photos, $lesson->id);

                $lesson->photos()->insert($photos);
            }

            return redirect()->route('lessons.index')->with('success', 'Lesson created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating lesson: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all(),
            ]);

            return redirect()->back()->with('error', 'Error creating lesson: ' . $e->getMessage());
        }
    }

    public function show(Lesson $lesson)
    {
        return view('admin.grammar-lessons.show', compact('lesson'));
    }

    public function edit($id)
    {
        $lesson = Lesson::with('photos')->findOrFail($id);

        return view('admin.grammar-lessons.edit', compact('lesson'));
    }

    public function update(UpdateLessonRequest $request, Lesson $lesson, DOMDocumentService $docService)
    {
        try {
            $validatedData = $request->validated();

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

            if ($request->hasFile('photos')) {
                $this->deletePhotos($lesson->id);

                $photos = $this->storePhotos($request->file('photos'), $lesson->id);
                $lesson->photos()->insert($photos);
            }

            if ($request->hasFile('voice')) {
                $newVoice = $request->file('voice')->store('voices', 'public');
                if ($lesson->voice && Storage::disk('public')->exists($lesson->voice)) {
                    Storage::disk('public')->delete($lesson->voice);
                }
                $validatedData['voice'] = $newVoice;
            }

            $lesson->update($validatedData);

            return redirect()->route('lessons.index')->with('success', 'Lesson updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating lesson: ' . $e->getMessage());
        }
    }
    public function deletePhotos($lessonId)
    {
        $photos = Photo::where('lesson_id', $lessonId)->get();

        foreach ($photos as $photo) {
            if (Storage::disk('public')->exists($photo['path'])) {
                Storage::disk('public')->delete($photo['path']);
            }
        }
    }

    public function storePhotos($data, $lessonId)
    {
        $photos = [];
        foreach ($data as $photo) {
            $photoPath = $photo->store('images', 'public');

            $photos[] = [
                'path' => $photoPath,
                'lesson_id' => $lessonId,
            ];
        }
        return $photos;
    }
    public function destroy(Lesson $lesson, DOMDocumentService $docService)
    {
        try {
            if (!empty($lesson->homework)) {
                $docService->delete($lesson->homework);
            }

            if (!empty($lesson->answer)) {
                $docService->delete($lesson->answer);
            }

            if ($lesson->video && Storage::disk('public')->exists($lesson->video)) {
                Storage::disk('public')->delete($lesson->video);
            }

            if ($lesson->voice && Storage::disk('public')->exists($lesson->voice)) {
                Storage::disk('public')->delete($lesson->voice);
            }

            if ($lesson->pdf && Storage::disk('public')->exists($lesson->pdf)) {
                Storage::disk('public')->delete($lesson->pdf);
            }

            $this->deletePhotos($lesson->id);

            $lesson->delete();

            return redirect()->route('lessons.index')->with('success', 'Lesson deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting lesson ' . $lesson->id . ': ' . $e->getMessage());

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
