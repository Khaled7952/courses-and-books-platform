<?php

namespace App\Http\Requests;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateArticleRequest extends FormRequest
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

    'title' => [
        'required',
        'string',
        'max:255',
        'unique:articles,title'
    ],

    'slug' => [
        'required',
        'string',
        'max:255',
        'unique:articles,slug'
    ],

    'short_description' => [
        'required',
        'string',
        'max:100',
    ],

    'content' => ['required', 'string'],

    'meta_title' => ['required', 'string', 'max:70'],

    'meta_description' => ['required', 'string', 'max:170'],

    'meta_keywords' => ['required', 'string', 'max:1000'],

    'image' => [
        'required',
        'image',
        'mimes:jpeg,png,jpg,webp',
        'max:2048'
    ],

    'status' => ['required', 'boolean'],

    'category_id' => ['nullable', 'exists:categories,id'],

    'tags' => ['nullable', 'array'],
    'tags.*' => ['integer', 'exists:tags,id'],
];

    }
}
