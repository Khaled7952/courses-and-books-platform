<?php
namespace App\Repositories\Dashboard\Blog;


interface IBlogRepository
{

    public function getBlogs();

    public function getCategories();

    public function createBlog(array $data);

    public function findBlogById($id);

    public function updateBlog($blog, array $data);

    public function destroy($blog);

}

