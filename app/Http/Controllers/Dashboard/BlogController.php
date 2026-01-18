<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Services\Dashboard\Blog\IBlogService;

class BlogController extends Controller
{
    protected $blog;

    public function __construct(IBlogService $blog)
    {
        $this->blog = $blog;
    }

    public function index()
    {
        $blogs = $this->blog->getBlogs();
        return view('dashboard.blog.index', compact('blogs'));
    }

    public function create()
    {
        $categories = $this->blog->getCategories();
        return view('dashboard.blog.create', compact('categories'));
    }

    public function store(CreateArticleRequest $request)
    {
        $data = $request->except(['_token']);
        $data['tags'] = $request->tags ?? [];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image');
        }

        $article = $this->blog->createBlog($data);

        if (!$article) {
            return back()->with('error', __('dashboard.error_msg'));
        }

        return redirect()->route('dashboard.blog.index')->with('success', __('dashboard.add_msg'));
    }

    public function edit($id)
    {
        $blog = $this->blog->findBlogById($id);
        $categories = $this->blog->getCategories();

        return view('dashboard.blog.edit', compact('blog', 'categories'));
    }

    public function update(UpdateArticleRequest $request, $id)
    {
        $data = $request->except(['_token', '_method']);
        $data['tags'] = $request->tags ?? [];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image');
        }

        $updated = $this->blog->updateBlog($data, $id);

        if (!$updated) {
            return back()->with('error', __('dashboard.error_msg'));
        }

        return redirect()->route('dashboard.blog.index')->with('success', __('dashboard.update_msg'));
    }
    public function destroy($id)
    {
        $deleted = $this->blog->destroy($id);

        if (!$deleted) {
            return back()->with('error', __('dashboard.error_msg'));
        }

        return redirect()->back()->with('success', __('dashboard.delete_msg'));
    }
}
