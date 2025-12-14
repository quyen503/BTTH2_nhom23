<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorCourseController extends Controller
{
    // Danh sách khóa học của giảng viên
    public function index()
    {
        $courses = Course::where('instructor_id', Auth::id())->get();
        return view('instructor.courses.index', compact('courses'));
    }

    // Form tạo khóa học
    public function create()
    {
        $categories = Category::all();
        return view('instructor.courses.create', compact('categories'));
    }

    // Lưu khóa học mới
    public function store(Request $request)
    {
        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'duration_weeks' => $request->duration_weeks,
            'level' => $request->level,
            'instructor_id' => Auth::id()
        ]);

        return redirect('/instructor/courses');
    }

    // Form sửa khóa học
    public function edit($id)
    {
        $course = Course::findOrFail($id);

        // Chặn sửa khóa của người khác
        if ($course->instructor_id != Auth::id()) {
            abort(403);
        }

        $categories = Category::all();
        return view('instructor.courses.edit', compact('course', 'categories'));
    }

    // Cập nhật khóa học
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        if ($course->instructor_id != Auth::id()) {
            abort(403);
        }

        $course->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'duration_weeks' => $request->duration_weeks,
            'level' => $request->level
        ]);

        return redirect('/instructor/courses');
    }

    // Xóa khóa học
    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        if ($course->instructor_id != Auth::id()) {
            abort(403);
        }

        $course->delete();
        return redirect('/instructor/courses');
    }
}
