<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Spatie\Translatable\HasTranslations;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'short_description' , 'content', 'meta_description', 'category_id' , 'meta_keywords', 'meta_title', 'image', 'status'];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d-m-Y');
    }

    public function tags()
{
    return $this->belongsToMany(Tag::class, 'article_tags', 'article_id', 'tag_id');
}

}
