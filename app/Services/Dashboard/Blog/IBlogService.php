<?php
namespace App\Services\Dashboard\Blog;

interface IBlogService
{
    public function getBlogs();
    public function getCategories();
    public function createBlog(array $data);
    public function findBlogById($id);
    public function updateBlog(array $data, $id);
    public function destroy($id);
}

