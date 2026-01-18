<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Services\Website\Courses\ICoursesWebService;


class HomeController extends Controller
{


    protected $coursesService;

    public function __construct(ICoursesWebService $coursesService)
    {
        $this->coursesService = $coursesService;
    }

    public function index()
    {
        $featuredCourses   = $this->coursesService->getFeaturedCourses(6);

        $bestSellingCourses = $this->coursesService->getBestSellingCourses(6);

        $coursesPaginated   = $this->coursesService->getCoursesPaginated(12);

        return view('website.home', compact(
            'featuredCourses',
            'bestSellingCourses',
            'coursesPaginated'
        ));
    }


}
