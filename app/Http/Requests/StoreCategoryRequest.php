<?php

namespace App\Http\Requests;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],

            'slug' => ['required', 'string', 'max:255', 'unique:categories,slug'],

            'icon' => ['nullable', 'string', 'max:255'],

            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],

            'meta_title' => ['required', 'string', 'max:70'],

            'meta_description' => ['required', 'string', 'max:170'],

            'meta_keywords' => ['required', 'string', 'max:1000'],

            'status' => ['required', 'boolean'],
        ];
    }
}
