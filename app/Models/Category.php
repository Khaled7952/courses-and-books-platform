<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name', 'slug', 'icon', 'image', 'meta_title', 'meta_description', 'meta_keywords', 'status', 'parent_id'];

    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id');
    }
}
