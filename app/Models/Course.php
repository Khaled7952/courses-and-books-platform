<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'description', 'price', 'image', 'benefits', 'rating_avg', 'rating_count', 'file_pdf', 'is_featured', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $casts = [
        'benefits' => 'array',
        'is_featured' => 'boolean',
    ];

    public function ratings()
    {
        return $this->hasMany(CourseRating::class, 'course_id');
    }
}
