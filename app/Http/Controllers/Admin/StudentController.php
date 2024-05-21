<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Services\DOMDocumentService;
use App\Services\UploadFileService;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        return view('admin.student.index', compact('students'));
    }

    public function store(StoreStudentRequest $request, DOMDocumentService $docService)
    {
        try {
            $validatedData = $request->validated();

            $ImagePath = UploadFileService::uploadFile($request->file('image'), 'images');

            Student::create([
                'name' => $validatedData['name'],
                'image' => $ImagePath,
                'desc' => $validatedData['desc'],
            ]);

            return redirect()->route('student.index')->with('success', 'Student created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating student: ' . $e->getMessage());
        }
    }

    public function edit(Student $student)
    {
        return view('admin.student.edit', compact('student'));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            if ($student->image && Storage::disk('public')->exists($student->image)) {
                UploadFileService::deleteFile($student->image);
            }
            $validatedData['image'] = UploadFileService::uploadFile($request->file('image'), 'images');
        }

        $student->update($validatedData);

        return redirect()->route('student.index')->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student, DOMDocumentService $docService)
    {
        try {
            $student = Student::find($student->id);

            if (!$student) {
                return redirect()->route('student.index')->with('error', 'student not found.');
            }


            if ($student->image) {
                UploadFileService::deleteFile($student->image);
            }

            $student->delete();

            return redirect()->route('student.index')->with('success', 'Student deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('student.index')->with('error', 'Error deleting student: ' . $e->getMessage());
        }
    }
}
