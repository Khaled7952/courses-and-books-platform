<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Form extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
    'name',
    'phone',
    'company_name',
    'email',
    'message',
    'device_fingerprint',
    'ip',
    'canvas_fingerprint',
    'webgl_fingerprint',
];


    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'created_at' => 'datetime',
    ];
}
