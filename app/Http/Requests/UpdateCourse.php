<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourse extends FormRequest
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
    public function rules()
{
    $id = $this->route('course');

    return [
        'title'             => 'required|string|max:255',

        'slug'              => 'required|string|max:255|unique:courses,slug,' . $id,

        'description'       => 'required|string',

        'price'             => 'required|numeric|min:0',

        'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        'file_pdf'          => 'nullable|mimes:pdf,doc,docx,epub,txt|max:20480',

        'benefits' => 'required|array',
        'benefits.*.benefit' => 'required|string|max:255',

        'rating_avg'        => 'nullable|numeric|min:0|max:5',
        'rating_count'      => 'nullable|integer|min:0',

        'is_featured'       => 'nullable|boolean',

        'meta_title'        => 'nullable|string|max:255',
        'meta_description'  => 'nullable|string',
        'meta_keywords'     => 'nullable|string',
    ];
}

}
