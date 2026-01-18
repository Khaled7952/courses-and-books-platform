<?php
namespace App\Repositories\Dashboard\Category;


interface ICategoryRepository {

    public function getAllCategories();
    public function getCategories();
    public function createCategory(array $data);
    public function findCategory($id);
    public function updateCategory($category, array $data);
    public function destroy($category);
}
