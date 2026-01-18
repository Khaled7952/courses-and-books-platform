<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\Dashboard\Category\ICategoryService;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(ICategoryService $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->getCategories();
        return view('dashboard.category.index', compact('categories'));
    }

    public function create()
    {
        $categories = $this->category->getAllCategories();
        return view('dashboard.category.create', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->except(['_token']);

        $category = $this->category->createCategory($data);

        if (!$category) {
            return redirect()->back()->with('error', __('dashboard.error_msg'));
        }

        return redirect()
            ->route('dashboard.category.index')
            ->with('success', __('dashboard.add_msg'));
    }

    public function edit($id)
    {
        $category = $this->category->findCategory($id);

        if (!$category) {
            return redirect()->back()->with('error', __('dashboard.error_msg'));
        }

        $categories = $this->category->getAllCategories();

        return view('dashboard.category.edit', compact('category', 'categories'));
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $data = $request->except(['_token', '_method']);

        $category = $this->category->updateCategory($this->category->findCategory($id), $data);

        if (!$category) {
            return redirect()->back()->with('error', __('dashboard.error_msg'));
        }

        return redirect()
            ->route('dashboard.category.index')
            ->with('success', __('dashboard.update_msg'));
    }

    public function destroy($id)
    {
        $category = $this->category->destroy($this->category->findCategory($id));

        if (!$category) {
            return redirect()->back()->with('error', __('dashboard.error_msg'));
        }

        return redirect()->back()->with('success', __('dashboard.delete_msg'));
    }
}
