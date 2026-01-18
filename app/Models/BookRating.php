<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookRating extends Model
{
    use HasFactory;

    protected $table = 'book_ratings';

    protected $fillable = [
        'book_id',
        'customer_id',
        'rating',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
