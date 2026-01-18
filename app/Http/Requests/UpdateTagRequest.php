<?php

namespace App\Http\Requests;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
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
       $id = $this->route('tag');

return [

    'name' => [
        'required',
        'string',
        'max:255',
        'unique:tags,name,' . $id
    ],

    'slug' => [
        'required',
        'string',
        'max:255',
        'unique:tags,slug,' . $id
    ],

    'meta_title' => ['required', 'string', 'max:70'],

    'meta_description' => ['required', 'string', 'max:170'],

    'meta_keywords' => ['required', 'string', 'max:1000'],

    'status' => ['required', 'boolean'],
];

    }
}
