<?php
namespace App\Repositories\Dashboard\Courses;


interface ICoursesRepository
{

    public function getCourses();

    public function createCourse(array $data);

    public function findCourseById($id);

    public function updateCourse($course, array $data);

    public function destroy($course);

}

