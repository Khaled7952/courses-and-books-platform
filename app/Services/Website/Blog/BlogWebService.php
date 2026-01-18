<?php

namespace App\Services\Website\Blog;

use App\Models\Article;
use App\Models\Category;

class BlogWebService implements IBlogWebService
{

    public function getFeaturedArticle()
    {
        return Article::active()
            ->with('category:id,name,slug')
            ->latest('created_at')
            ->first([
                'id',
                'title',
                'slug',
                'short_description',
                'image',
                'created_at',
                'category_id'
            ]);
    }


    public function getLatestArticles(int $excludeId)
    {
        return Article::active()
            ->with('category:id,name,slug')
            ->when($excludeId, function ($q) use ($excludeId) {
                $q->where('id', '!=', $excludeId);
            })
            ->latest('created_at')
            ->take(3)
            ->get([
                'id',
                'title',
                'slug',
                'short_description',
                'image',
                'created_at',
                'category_id'
            ]);
    }


    public function getArticlesPaginated()
    {
        return Article::active()
            ->with('category:id,name,slug')
            ->latest('created_at')
            ->paginate(9, [
                'id',
                'title',
                'slug',
                'short_description',
                'image',
                'created_at',
                'category_id'
            ]);
    }


    public function getArticleBySlug(string $slug)
    {
        return Article::active()
            ->with([
                'category:id,name,slug',
                'tags:id,name,slug'
            ])
            ->where('slug', $slug)
            ->firstOrFail();
    }


    public function getArticlesByCategorySlug(string $slug)
    {
        return Category::active()
            ->where('slug', $slug)
            ->with(['articles' => function ($q) {
                $q->active()
                  ->latest('created_at')
                  ->select([
                      'id',
                      'title',
                      'slug',
                      'short_description',
                      'image',
                      'created_at',
                      'category_id'
                  ]);
            }])
            ->firstOrFail();
    }

    public function getSidebarCategories()
    {
        return Category::active()
            ->whereHas('articles', function ($q) {
                $q->active();
            })
            ->orderBy('name')
            ->get(['id', 'name', 'slug']);
    }

    public function getRelatedArticlesByCategoryId(int $categoryId, int $limit = 9)
{
    return Article::active()
        ->where('category_id', $categoryId)
        ->latest('created_at')
        ->paginate(9, [
            'id',
            'title',
            'slug',
            'short_description',
            'image',
            'created_at',
            'category_id'
        ]);
}

}
