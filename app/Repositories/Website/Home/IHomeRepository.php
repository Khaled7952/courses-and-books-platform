<?php
namespace App\Repositories\Website\Home;


interface IHomeRepository{

    public function getFaq();
    public function getFaqDetails();
    public function getTestimonials();

    public function getFeatures();
    public function getHowWeWork();

    public function getMealCategories();
    public function getMeals(?int $categoryId = null, int $limit = 10);

    public function getPackagesPreview(int $limit = 6);
    public function getPackageWithMeals(int $packageId);

}
