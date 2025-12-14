<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorMaterialController extends Controller
{
    // Danh sách tài liệu của bài học
    public function index($lessonId)
    {
        $lesson = Lesson::with('course')->findOrFail($lessonId);

        // Chỉ giảng viên sở hữu khóa học mới được truy cập
        if ($lesson->course->instructor_id != Auth::id()) {
            abort(403);
        }

        $materials = Material::where('lesson_id', $lessonId)->get();

        return view('instructor.materials.index', compact('lesson', 'materials'));
    }

    // Form upload tài liệu
    public function create($lessonId)
    {
        $lesson = Lesson::with('course')->findOrFail($lessonId);

        if ($lesson->course->instructor_id != Auth::id()) {
            abort(403);
        }

        return view('instructor.materials.create', compact('lesson'));
    }

    // Lưu tài liệu
    public function store(Request $request, $lessonId)
    {
        $lesson = Lesson::with('course')->findOrFail($lessonId);

        if ($lesson->course->instructor_id != Auth::id()) {
            abort(403);
        }

        $file = $request->file('file');
        $path = $file->store('materials', 'public');

        Material::create([
            'lesson_id' => $lessonId,
            'filename' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $file->getClientOriginalExtension()
        ]);

        return redirect("/instructor/lessons/$lessonId/materials");
    }
}
