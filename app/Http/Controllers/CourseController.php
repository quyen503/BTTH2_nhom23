<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query();

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $courses = $query->paginate(6);

        return view('courses.index', compact('courses'));
    }
    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.show', compact('course'));
    }

    public function enroll($id)
    {
        $course = Course::findOrFail($id);

        Auth::user()->courses()->syncWithoutDetaching([
            $course->id => ['progress' => 0]
        ]);

        return redirect()->back()->with('success', 'Đăng ký khóa học thành công');
    }

    public function myCourses()
    {
        $courses = auth()->user()->courses;
        return view('courses.my', compact('courses'));
    }

}
