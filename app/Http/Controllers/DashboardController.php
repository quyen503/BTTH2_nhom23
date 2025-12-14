<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 0) {
            return view('student.dashboard');
        }

        if ($user->role == 1) {
            return view('instructor.dashboard');
        }

        if ($user->role == 2) {
            return view('admin.dashboard');
        }

        // ❌ KHÔNG redirect về login
        abort(403, 'Không có quyền truy cập');
    }
}
