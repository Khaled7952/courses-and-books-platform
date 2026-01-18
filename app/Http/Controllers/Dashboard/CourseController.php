<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StroreCourse;
use App\Http\Requests\UpdateCourse;
use App\Services\Dashboard\Courses\ICoursesService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $courses;

    public function __construct(ICoursesService $courses)
    {
        $this->courses = $courses;
    }

    public function index()
    {
        $courses = $this->courses->getCourses();

        return view('dashboard.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('dashboard.courses.create');
    }

    public function store(StroreCourse $request)
    {
        $data = $request->except('_token');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image');
        }

        if ($request->has('benefits') && is_array($request->benefits)) {
            $data['benefits'] = $request->benefits;
        }

        $created = $this->courses->createCourse($data);

        if (!$created) {
            return back()->with('error', __('dashboard.error_msg'));
        }

        return redirect()->route('dashboard.courses.index')
            ->with('success', __('dashboard.add_msg'));
    }

    public function edit($id)
    {
        $course = $this->courses->findCourseById($id);

        return view('dashboard.courses.edit', compact('course'));
    }

    public function update(UpdateCourse $request, $id)
    {
        $data = $request->except(['_token','_method']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image');
        }

        if ($request->has('benefits') && is_array($request->benefits)) {
            $data['benefits'] = $request->benefits;
        }

        $updated = $this->courses->updateCourse($id, $data);

        if (!$updated) {
            return back()->with('error', __('dashboard.error_msg'));
        }

        return redirect()->route('dashboard.courses.index')
            ->with('success', __('dashboard.update_msg'));
    }

    public function destroy($id)
    {
        $deleted = $this->courses->destroy($id);

        if (!$deleted) {
            return back()->with('error', __('dashboard.error_msg'));
        }

        return redirect()->back()->with('success', __('dashboard.delete_msg'));
    }
}
