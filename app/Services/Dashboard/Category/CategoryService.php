<?php
namespace App\Services\Dashboard\Category;

use App\Repositories\Dashboard\Category\ICategoryRepository;

Class CategoryService implements ICategoryService {

    protected $repo;

    public function __construct(ICategoryRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAllCategories()
    {
        return $this->repo->getAllCategories();
    }

    public function getCategories()
    {
        return $this->repo->getCategories();
    }

    public function createCategory(array $data)
    {
        return $this->repo->createCategory($data);
    }

    public function findCategory($id)
    {
        return $this->repo->findCategory($id);
    }

    public function updateCategory($category, array $data)
    {
        return $this->repo->updateCategory($category, $data);
    }

    public function destroy($category)
    {
        return $this->repo->destroy($category);
    }
}
