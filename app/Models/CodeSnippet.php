<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodeSnippet extends Model
{
    protected $fillable = [
        'header_code',
        'footer_code',
        'body_code',
    ];
}
