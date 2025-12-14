<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // Danh sách khóa học
    public function index()
    {
        $courses = Course::with('instructor', 'category')->get();
        return view('courses.index', compact('courses'));
    }

    // Chi tiết khóa học
    public function show($id)
    {
        $course = Course::with('instructor', 'category', 'lessons')->findOrFail($id);

        $isEnrolled = false;
        if (Auth::check()) {
            $isEnrolled = Enrollment::where('course_id', $id)
                ->where('student_id', Auth::id())
                ->exists();
        }

        return view('courses.show', compact('course', 'isEnrolled'));
    }

    // Đăng ký khóa học
    public function enroll($id)
    {
        Enrollment::create([
            'course_id' => $id,
            'student_id' => Auth::id(),
            'status' => 'active',
            'progress' => 0
        ]);

        return redirect('/my-courses');
    }
}
