<?php

namespace App\Services\Website\Courses;

interface ICoursesWebService
{

    public function getFeaturedCourses(int $limit = 6);
    public function getBestSellingCourses(int $limit = 6);
    public function getCoursesPaginated(int $perPage = 12);
    public function getCourseBySlug(string $slug);
}
