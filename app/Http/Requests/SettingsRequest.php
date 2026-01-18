<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
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

        'email' => ['nullable', 'email'],
        'phone' => ['nullable', 'string', 'max:30'],
        'whatsapp' => ['nullable', 'string', 'max:30'],
        'address' => ['nullable', 'string', 'max:255'],

        'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:4096'],
        'hero_book_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:4096'],

        'hero_title' => ['nullable', 'string', 'max:255'],
        'hero_description' => ['nullable', 'string'],

        'banner_title' => ['nullable', 'string', 'max:255'],
        'banner_subtitle' => ['nullable', 'string', 'max:255'],

        'doctor_about' => ['nullable', 'string'],

        'social_links' => ['nullable', 'array'],
        'social_links.*.link' => ['nullable', 'url'],
        'social_links.*.icon' => ['nullable', 'string', 'max:50'],

        ];
    }
}
