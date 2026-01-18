<?php

namespace App\Repositories\Dashboard\Courses;

use App\Models\Course;

class CoursesRepository implements ICoursesRepository
{
    public function getCourses()
    {
        return Course::select('id', 'title', 'price', 'rating_avg', 'rating_count' , 'is_featured')
            ->latest()
            ->paginate(10);
    }


    public function createCourse(array $data)
    {
        return Course::create($data);
    }


    public function findCourseById($id)
    {
        return Course::findOrFail($id);
    }


    public function updateCourse($course, array $data)
    {
        $course->update($data);

        return $course;
    }


    public function destroy($course)
    {
        return $course->delete();
    }
}
