<?php
namespace App\Repositories\Dashboard\Blog;

use App\Models\Article;
use App\Models\Category;

class BlogRepository implements IBlogRepository
{
    public function getBlogs()
    {
        return Article::with('category:id,name')
            ->select('id', 'title', 'category_id', 'status')
            ->latest()
            ->paginate(10);
    }

    public function getCategories()
    {
        return Category::select('id', 'name')->get();
    }

    public function createBlog(array $data)
    {
        return Article::create($data);
    }

    public function findBlogById($id)
{
    return Article::with(['tags:id,name', 'category:id,name'])->findOrFail($id);
}


    public function updateBlog($blog, array $data)
    {
        $blog->update($data);
        return $blog;
    }

    public function destroy($blog)
    {
        return $blog->delete();
    }
}
