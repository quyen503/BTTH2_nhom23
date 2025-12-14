<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;//KHAI BÁO ROUTE DASHBOARD
use App\Http\Controllers\CourseController; //KHAI BÁO ROUTE CHO KHÓA HỌC
use App\Http\Controllers\InstructorCourseController;//KHAI BÁO ROUTE GIẢNG VIÊN
use App\Http\Controllers\InstructorLessonController;//KHAI BÁO ROUTE BÀI HỌC
use App\Http\Controllers\InstructorMaterialController;//KHAI BÁO ROUTE UPLOAD
use App\Http\Controllers\StudentCourseController;//ROUTE HỌC VIÊN

// Trang chủ
Route::get('/', function () {
    return view('welcome');
});

// Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'handleLogin']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'handleRegister']);
Route::get('/logout', [AuthController::class, 'logout']);

//
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// Học viên - khóa học
Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show']);

Route::post('/courses/{id}/enroll', [CourseController::class, 'enroll'])->middleware('auth');

//KHAI BÁO ROUTE GIẢNG VIÊN
Route::middleware('auth')->group(function () {
    Route::get('/instructor/courses', [InstructorCourseController::class, 'index']);
    Route::get('/instructor/courses/create', [InstructorCourseController::class, 'create']);
    Route::post('/instructor/courses', [InstructorCourseController::class, 'store']);
    Route::get('/instructor/courses/{id}/edit', [InstructorCourseController::class, 'edit']);
    Route::post('/instructor/courses/{id}/update', [InstructorCourseController::class, 'update']);
    Route::get('/instructor/courses/{id}/delete', [InstructorCourseController::class, 'destroy']);
});

//KHAI BÁO ROUTE BÀI HỌC
Route::middleware('auth')->group(function () {
    Route::get('/instructor/courses/{course}/lessons', [InstructorLessonController::class, 'index']);
    Route::get('/instructor/courses/{course}/lessons/create', [InstructorLessonController::class, 'create']);
    Route::post('/instructor/courses/{course}/lessons', [InstructorLessonController::class, 'store']);
});

//KHAI BÁO ROUTE UPLOAD
Route::middleware('auth')->group(function () {
    Route::get('/instructor/lessons/{lesson}/materials', [InstructorMaterialController::class, 'index']);
    Route::get('/instructor/lessons/{lesson}/materials/create', [InstructorMaterialController::class, 'create']);
    Route::post('/instructor/lessons/{lesson}/materials', [InstructorMaterialController::class, 'store']);
});

//ROUTE HỌC VIÊN
Route::middleware('auth')->group(function () {
    Route::get('/my-courses', [StudentCourseController::class, 'myCourses']);
    Route::get('/my-courses/{course}/lessons', [StudentCourseController::class, 'lessons']);
    Route::get('/lessons/{lesson}', [StudentCourseController::class, 'lessonDetail']);
});

//ChanRow
Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/instructor/courses', [InstructorCourseController::class, 'index']);
    Route::get('/instructor/courses/create', [InstructorCourseController::class, 'create']);
    Route::post('/instructor/courses', [InstructorCourseController::class, 'store']);
    Route::get('/instructor/courses/{id}/edit', [InstructorCourseController::class, 'edit']);
    Route::post('/instructor/courses/{id}/update', [InstructorCourseController::class, 'update']);
    Route::get('/instructor/courses/{id}/delete', [InstructorCourseController::class, 'destroy']);

    Route::get('/instructor/courses/{course}/lessons', [InstructorLessonController::class, 'index']);
    Route::get('/instructor/courses/{course}/lessons/create', [InstructorLessonController::class, 'create']);
    Route::post('/instructor/courses/{course}/lessons', [InstructorLessonController::class, 'store']);

    Route::get('/instructor/lessons/{lesson}/materials', [InstructorMaterialController::class, 'index']);
    Route::get('/instructor/lessons/{lesson}/materials/create', [InstructorMaterialController::class, 'create']);
    Route::post('/instructor/lessons/{lesson}/materials', [InstructorMaterialController::class, 'store']);
});

//TẠO TRANG “KHÓA HỌC CỦA TÔI”
Route::get('/my-courses', function () {
    $enrollments = \App\Models\Enrollment::with('course')
        ->where('student_id', auth()->id())
        ->get();

    return view('student.my_courses', compact('enrollments'));
})->middleware('auth');
