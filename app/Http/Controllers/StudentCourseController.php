<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;

class StudentCourseController extends Controller
{
    // Khóa học đã đăng ký
    public function myCourses()
    {
        $courses = Course::whereIn('id',
            Enrollment::where('student_id', Auth::id())->pluck('course_id'))->get();

        return view('student.courses', compact('courses'));
    }

    // Danh sách bài học
    public function lessons($courseId)
    {
        $enrolled = Enrollment::where('course_id', $courseId)
            ->where('student_id', Auth::id())
            ->exists();

        if (!$enrolled) abort(403);

        $course = Course::findOrFail($courseId);
        $lessons = Lesson::where('course_id', $courseId)
            ->orderBy('order')
            ->get();

        return view('student.lessons', compact('course', 'lessons'));
    }

    // Chi tiết bài học
    public function lessonDetail($lessonId)
    {
        $lesson = Lesson::with('materials')->findOrFail($lessonId);

        $enrolled = Enrollment::where('course_id', $lesson->course_id)
            ->where('student_id', Auth::id())
            ->exists();

        if (!$enrolled) abort(403);

        return view('student.lesson_detail', compact('lesson'));
    }
}
