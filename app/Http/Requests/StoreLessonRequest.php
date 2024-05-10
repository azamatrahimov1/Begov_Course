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
            'video' => 'required',
            'name_image' => 'required',
            'voice' => 'required|mimes:mp3,ogg,wav,flac,aac',
            'pdf' => 'required|mimes:docx,pdf',
            'homework' => 'required',
            'answer' => 'required',
        ];
    }
}
