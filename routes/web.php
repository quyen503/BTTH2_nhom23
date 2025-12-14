<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;



Route::get('/courses/{id}', [CourseController::class, 'show'])
    ->name('courses.show');

Route::get('/courses', [CourseController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ADMIN (ROLE = 2)
Route::middleware(['auth', 'role:2'])->group(function () {

    // Danh sách user
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users');

    // Thêm user
    Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users/store', [AdminUserController::class, 'store'])->name('admin.users.store');

    // Sửa user
    Route::get('/admin/users/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/update/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');

    // Xoá user
    Route::delete('/admin/users/delete/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.delete');

    // Đổi role user (nếu cần)
    Route::get('/admin/users/role/{id}/{role}', [AdminUserController::class, 'changeRole'])->name('admin.users.role');
});

// Logout (GET → Redirect)
Route::get('/logout', function () {
    auth()->logout();
    return redirect('/login');
});

require __DIR__.'/auth.php';
