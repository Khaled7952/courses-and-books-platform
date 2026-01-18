<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['hero_title', 'hero_description', 'hero_book_image',
     'banner_title', 'banner_subtitle', 'doctor_about', 'email', 'phone',
      'whatsapp', 'address', 'social_links', 'logo' , 'privacy_policy'];

    protected $casts = [
        'social_links' => 'array',
    ];
}
