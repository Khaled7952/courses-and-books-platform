<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Website\Blog\IBlogWebService;
use Illuminate\Http\Request;

class BlogWebController extends Controller
{
    protected IBlogWebService $blogService;

    public function __construct(IBlogWebService $blogService)
    {
        $this->blogService = $blogService;
    }
    public function index()
    {
        $featuredArticle = $this->blogService->getFeaturedArticle();

        $articles = $this->blogService->getArticlesPaginated($featuredArticle?->id);

        return view('website.blog.index',
        compact('featuredArticle', 'articles'));
    }

    public function show($slug)
    {
        $article = $this->blogService->getArticleBySlug($slug);

        $categories = $this->blogService->getSidebarCategories();

        $latestArticles = $this->blogService->getLatestArticles($article->id);

        return view('website.blog.show', compact(
            'article',
            'categories',
            'latestArticles'
        ));
    }

    public function category($id)
{
    $category = Category::active()->findOrFail($id);

    $articles = $this->blogService->getRelatedArticlesByCategoryId($id);

    return view('website.blog.category', compact('category','articles'));
}

}
