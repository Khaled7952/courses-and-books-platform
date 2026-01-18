<?php

namespace App\Services\Dashboard\Blog;

use App\Repositories\Dashboard\Blog\IBlogRepository;
use App\Utils\ImageManger;

class BlogService implements IBlogService
{
    protected $repo, $image;

    public function __construct(IBlogRepository $repo, ImageManger $image)
    {
        $this->repo = $repo;
        $this->image = $image;
    }

    public function getBlogs()
    {
        return $this->repo->getBlogs();
    }

    public function getCategories()
    {
        return $this->repo->getCategories();
    }

    public function createBlog(array $data)
    {
        if (isset($data['image']) && !empty($data['image'])) {
            $data['image'] = $this->image->uploadSingleImage('/', $data['image'], 'general');
        }

        $article = $this->repo->createBlog($data);

        if (isset($data['tags']) && is_array($data['tags'])) {
            $article->tags()->sync($data['tags']);
        }

        return $article;
    }

    public function findBlogById($id)
    {
        return $this->repo->findBlogById($id);
    }

    public function updateBlog(array $data, $id)
    {
        $blog = $this->repo->findBlogById($id);

        if (isset($data['image']) && !empty($data['image'])) {
            if (!empty($blog->image)) {
                $this->image->deleteImageFromLocal('uploads/general/' . $blog->image);
            }
            $data['image'] = $this->image->uploadSingleImage('/', $data['image'], 'general');
        }

        $this->repo->updateBlog($blog, $data);

        if (isset($data['tags']) && is_array($data['tags'])) {
            $blog->tags()->sync($data['tags']);
        }

        return $blog;
    }

    public function destroy($id)
    {
        $blog = $this->repo->findBlogById($id);

        if (!empty($blog->image)) {
            $this->image->deleteImageFromLocal('uploads/general/' . $blog->image);
        }

        return $this->repo->destroy($blog);
    }
}
