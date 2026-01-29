<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\CourseService;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index()
    {
        $instructor_id = Auth::user()->id;
        $all_courses = Course::where('instructor_id', $instructor_id)
            ->with('category', 'subCategory')
            ->latest()
            ->get();
        return view('backend.instructor.course.index', compact('all_courses'));
    }

    public function create()
    {
        $all_categories = Category::all();
        return view('backend.instructor.course.create', compact('all_categories'));
    }

    public function store(CourseRequest $request)
    {
        $validatedData = $request->validated();

        // Always default course_goals to empty array
        $courseGoals = $validatedData['course_goals'] ?? [];

        $course = $this->courseService->createCourse(
            $validatedData,
            $request->file('course_image')
        );

        // Manage Course Goal
        if (!empty($courseGoals)) {
            $this->courseService->createCourseGoals($course->id, $courseGoals);
        }

        return back()->with('success', 'Course created successfully!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $all_categories = Category::all();
        $course = Course::with('subCategory')->findOrFail($id);

        // Always fetch course goals safely
        $course_goals = CourseGoal::where('course_id', $id)->get() ?? collect();

        return view('backend.instructor.course.edit', compact('all_categories', 'course', 'course_goals'));
    }

    public function update(CourseRequest $request, string $id)
    {
        $validatedData = $request->validated();

        // Always default course_goals to empty array
        $courseGoals = $validatedData['course_goals'] ?? [];

        $course = $this->courseService->updateCourse(
            $validatedData,
            $request->file('course_image'),
            $id
        );

        // Manage Course Goal
        $this->courseService->updateCourseGoals($course->id, $courseGoals);

        return back()->with('success', 'Course updated successfully!');
    }

    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);

        // Delete associated image if it exists
        if ($course->course_image) {
            $imagePath = public_path($course->course_image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $course->delete();

        return redirect()->route('instructor.course.index')->with('success', 'Course deleted successfully.');
    }
}
