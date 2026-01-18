<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'price' => 'nullable|numeric',
            'cover_image' => 'nullable|image|mimes:jpg,png,jpeg,webp',
            'back_image' => 'nullable|image|mimes:jpg,png,jpeg,webp',
            'file_pdf' => 'nullable|mimes:pdf,doc,docx,epub,txt|max:20480',
            'short_description' => 'nullable|string',
            'details' => 'nullable|string',
            'about_author' => 'nullable|string',
        ];
    }
}
