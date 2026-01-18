<?php
namespace App\Services\Dashboard\Courses;

interface ICoursesService {

    public function getCourses();

    public function createCourse(array $data);

    public function findCourseById($id);

    public function updateCourse($id, array $data);

    public function destroy($id);

}
