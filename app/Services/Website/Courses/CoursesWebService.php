<?php

namespace App\Services\Website\Courses;

use App\Models\Course;
use App\Models\OrderItem;

class CoursesWebService implements ICoursesWebService
{
    protected $course;
    protected $orderItem;

    public function __construct(Course $course, OrderItem $orderItem)
    {
        $this->course = $course;
        $this->orderItem = $orderItem;
    }

    public function getFeaturedCourses(int $limit = 6){

        return $this->course
        ->where('is_featured', 1)
        ->latest()
        ->take($limit)
        ->get([
            'id',
            'title',
            'slug',
            'price',
            'image',
        ]);
    }
    public function getBestSellingCourses(int $limit = 6){
        $bestSellingIds = $this->orderItem
        ->where('item_type', Course::class)
        ->where('status', 'completed')
        ->selectRaw('item_id, COUNT(*) as total_sales')
        ->groupBy('item_id')
        ->orderByDesc('total_sales')
        ->limit($limit)
        ->pluck('item_id')
        ->toArray();

         return $this->course
        ->whereIn('id', $bestSellingIds)
        ->orderByRaw('FIELD(id, '.implode(',', $bestSellingIds).')')
        ->get([
            'id',
            'title',
            'slug',
            'price',
            'image',
        ]);
    }
    public function getCoursesPaginated(int $perPage = 12){
        return $this->course
        ->latest()
        ->paginate(
            $perPage,
            [
                'id',
                'title',
                'slug',
                'price',
                'image'
            ]
        );
    }
    public function getCourseBySlug(string $slug){
        return $this->course
        ->where('slug', $slug)
        ->firstOrFail();
    }
}
