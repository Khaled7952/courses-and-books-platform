<?php

namespace App\Services\Website\Blog;

interface IBlogWebService
{
    public function getFeaturedArticle();

    public function getLatestArticles(int $excludeId);

    public function getArticlesPaginated();

    public function getArticleBySlug(string $slug);

    public function getArticlesByCategorySlug(string $slug);

    public function getSidebarCategories();

    public function getRelatedArticlesByCategoryId(int $categoryId, int $limit = 9);
}
