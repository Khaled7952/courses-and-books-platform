<?php

namespace App\Services\Dashboard\Courses;

use App\Repositories\Dashboard\Courses\ICoursesRepository;
use App\Utils\ImageManger;

class CoursesService implements ICoursesService
{
    protected $repo, $image;

    public function __construct(ICoursesRepository $repo, ImageManger $image)
    {
        $this->repo  = $repo;
        $this->image = $image;
    }

    public function getCourses()
    {
        return $this->repo->getCourses();
    }

  public function createCourse(array $data)
{
    if (!empty($data['image'])) {
        $data['image'] = $this->image->uploadSingleImage('/', $data['image'], 'general');
    }

    if (!empty($data['file_pdf'])) {
        $data['file_pdf'] = $this->image->uploadSingleImage('/', $data['file_pdf'], 'pdfbooks');
    }

    return $this->repo->createCourse($data);
}


    public function findCourseById($id)
    {
        return $this->repo->findCourseById($id);
    }


    public function updateCourse($id, array $data)
{
    $course = $this->repo->findCourseById($id);

    // ===== IMAGE =====
    if (!empty($data['image'])) {

        if (!empty($course->image)) {
            $this->image->deleteImageFromLocal('uploads/general/' . $course->image);
        }

        $data['image'] = $this->image->uploadSingleImage('/', $data['image'], 'general');
    }

    // ===== PDF FILE =====
    if (!empty($data['file_pdf'])) {

        if (!empty($course->file_pdf)) {
            $this->image->deleteImageFromLocal('uploads/pdfbooks/' . $course->file_pdf);
        }

        $data['file_pdf'] = $this->image->uploadSingleImage('/', $data['file_pdf'], 'pdfbooks');
    }

    return $this->repo->updateCourse($course, $data);
}

    public function destroy($id)
    {
        $course = $this->repo->findCourseById($id);

        if (!empty($course->image)) {
            $this->image->deleteImageFromLocal('uploads/general/' . $course->image);
        }

        return $this->repo->destroy($course);
    }
}
