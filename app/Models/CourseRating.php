<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseRating extends Model
{
    use HasFactory;

    protected $table = 'course_ratings';

    protected $fillable = [
        'course_id',
        'customer_id',
        'rating',
        'comment',
    ];

    public function course()
{
    return $this->belongsTo(Course::class, 'course_id');
}

public function customer()
{
    return $this->belongsTo(Customer::class, 'customer_id');
}

}
