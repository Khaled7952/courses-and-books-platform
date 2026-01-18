<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
     protected $fillable = [
        'title',
        'subtitle',
        'price',
        'cover_image',
        'back_image',
        'file_pdf',
        'short_description',
        'details',
        'about_author',
        'rating_avg',
        'rating_count',
    ];

    public function ratings()
{
    return $this->hasMany(BookRating::class);
}

}
