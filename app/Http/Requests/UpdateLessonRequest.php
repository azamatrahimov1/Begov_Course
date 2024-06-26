<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLessonRequest extends FormRequest
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
            'name' => 'string',
            'name_video' => 'string',
            'video' => 'file|mimes:mp4,avi,mov',
            'name_image' => 'string',
            'photos' => 'file|mimes:jpg,png,webp,jpeg',
            'voice' => 'file|mimes:mp3,ogg,wav,flac,aac',
            'pdf' => 'mimes:docx,pdf',
            'homework' => 'string',
            'answer' => 'string',
        ];
    }
}
