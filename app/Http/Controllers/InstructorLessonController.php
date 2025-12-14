<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorLessonController extends Controller
{
    // Danh sách bài học của khóa học
    public function index($courseId)
    {
        $course = Course::findOrFail($courseId);

        // Chỉ giảng viên sở hữu mới được truy cập
        if ($course->instructor_id != Auth::id()) {
            abort(403);
        }

        $lessons = Lesson::where('course_id', $courseId)
            ->orderBy('order')
            ->get();

        return view('instructor.lessons.index', compact('course', 'lessons'));
    }

    // Form tạo bài học
    public function create($courseId)
    {
        $course = Course::findOrFail($courseId);

        if ($course->instructor_id != Auth::id()) {
            abort(403);
        }

        return view('instructor.lessons.create', compact('course'));
    }

    // Lưu bài học
    public function store(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);

        if ($course->instructor_id != Auth::id()) {
            abort(403);
        }

        Lesson::create([
            'course_id' => $courseId,
            'title' => $request->title,
            'content' => $request->content,
            'order' => $request->order
        ]);

        return redirect("/instructor/courses/$courseId/lessons");
    }
}
