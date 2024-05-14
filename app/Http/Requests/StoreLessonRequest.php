<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLessonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'name_video' => 'required',
            'video' => 'required|file|mimes:mp4,avi,mov',
            'name_image' => 'required',
            'photos' => 'required|file|mimes:jpg,png,webp,jpeg',
            'voice' => 'required|file|mimes:mp3,ogg,wav,flac,aac',
            'pdf' => 'required|file|mimes:docx,pdf',
            'homework' => 'required',
            'answer' => 'required',
        ];
    }
}
