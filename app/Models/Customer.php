<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory , Notifiable;

    protected $fillable = [
        'name',
        'mobile',
        'password',
        'is_mobile_verified',
        'is_active',
        'mobile_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'mobile_verified_at' => 'datetime',
            'is_mobile_verified' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function bookRatings()
{
    return $this->hasMany(BookRating::class);
}

public function courseRatings()
{
    return $this->hasMany(CourseRating::class, 'customer_id');
}


}
