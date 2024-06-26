<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTypeOfLessonsRequest extends FormRequest
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
            'title' => 'string',
            'image' => 'file|mimes:jpg,png,webp,jpeg',
            'desc' => 'string',
            'price' => 'numeric',
            'teacher' => 'required',
            'student' => 'required',
            'hour' => 'required'
        ];
    }
}
