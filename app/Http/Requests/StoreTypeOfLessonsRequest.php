<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTypeOfLessonsRequest extends FormRequest
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
            'image' => 'required|file|mimes:jpg,png,webp,jpeg',
            'title' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'teacher' => 'required',
            'student' => 'required',
            'hour' => 'required'
        ];
    }
}
