<?php

namespace App\Services\Website\Home;

use App\Repositories\Website\Home\IHomeRepository;

class HomeService implements IHomeService
{
    protected $homeRepository;

    public function __construct(IHomeRepository $homeRepository)
    {
        $this->homeRepository = $homeRepository;
    }

    public function getFaq()
    {
        return $this->homeRepository->getFaq();
    }

    public function getFaqDetails()
    {
        return $this->homeRepository->getFaqDetails();
    }

    public function getTestimonials()
    {
        return $this->homeRepository->getTestimonials();
    }

    public function getFeatures()
    {
        return $this->homeRepository->getFeatures();
    }

    public function getHowWeWork()
    {
        return $this->homeRepository->getHowWeWork();
    }

    public function getMealCategories()
    {
        return $this->homeRepository->getMealCategories();
    }

    public function getMeals(?int $categoryId = null, int $limit = 10)
    {
        return $this->homeRepository->getMeals($categoryId, $limit);
    }

    public function getPackagesPreview(int $limit = 6)
    {
        return $this->homeRepository->getPackagesPreview($limit);
    }

    public function getPackageWithMeals(int $packageId)
    {
        return $this->homeRepository->getPackageWithMeals($packageId);
    }
}
