<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Update_Lesson_Request extends FormRequest
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
            'name_video' => 'required',
            'video' => 'required|file|mimes:mp4,avi,mov,wmv',
            'name_image' => 'required',
            'image' => 'required|mimes:png,jpg,webp',
            'voice' => 'required|mimes:mp3,ogg,wav,flac,aac',
            'pdf' => 'required|mimes:docx,pdf',
            'homework' => 'required',
            'answer' => 'required',
        ];
    }
}
