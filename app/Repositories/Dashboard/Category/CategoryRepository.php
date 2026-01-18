<?php
namespace App\Repositories\Dashboard\Category;

use App\Models\Category;

class CategoryRepository implements ICategoryRepository
{
    public function getAllCategories()
    {
        return Category::select('id', 'name', 'status')->get();
    }

    public function getCategories()
    {
        return Category::with('parent:id,name')->select('id', 'name', 'status', 'parent_id')->paginate(10);
    }

    public function createCategory(array $data)
    {
        return Category::create($data);
    }

    public function findCategory($id)
    {
        return Category::findOrFail($id);
    }

    public function updateCategory($category, array $data)
    {
        $category->update($data);
        return $category;
    }

    public function destroy($category)
    {
        return $category->delete();
    }
}
