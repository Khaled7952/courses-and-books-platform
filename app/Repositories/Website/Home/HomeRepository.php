<?php
namespace App\Repositories\Website\Home;

use App\Models\Header;
use App\Models\AboutUs;
use App\Models\Category;
use App\Models\Client;
use App\Models\Faq;
use App\Models\FaqDetail;
use App\Models\FeaturesAndWorks;
use App\Models\Meal;
use App\Models\Package;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Slider;
use App\Models\Team;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class HomeRepository implements IHomeRepository
{
    public function getFaqDetails()
    {
        return FaqDetail::first();
    }

    public function getFaq()
    {
        return Faq::active()->orderBy('sort_order', 'asc')->get();
    }

    public function getTestimonials()
    {
        return Testimonial::active()->orderBy('sort_order', 'asc')->get();
    }

    public function getFeatures()
    {
        return FeaturesAndWorks::active()->features()->ordered()->get();
    }

    public function getHowWeWork()
    {
        return FeaturesAndWorks::active()->howWeWork()->ordered()->get();
    }

    public function getMealCategories()
    {
        return Category::where('status', 1)->orderBy('order')->get();
    }

    public function getMeals(?int $categoryId = null, int $limit = 10)
    {
        $query = Meal::where('status', 1)->orderBy('order');

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        return $query->limit($limit)->get();
    }

    public function getPackagesPreview(int $limit = 6)
    {
        return Package::where('status', 1)->select('id', 'name', 'short_description', 'image')->orderBy('order')->limit($limit)->get();
    }

    public function getPackageWithMeals(int $packageId)
    {
        return Package::where('status', 1)
            ->with([
                'meals' => function ($q) {
                    $q->where('status', 1)->orderBy('order');
                },
            ])
            ->findOrFail($packageId);
    }
}
