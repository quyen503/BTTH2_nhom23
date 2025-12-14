<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Hiển thị form đăng ký
    public function register()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function handleRegister(Request $request)
    {
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'fullname' => $request->fullname,
            'role' => 0 // mặc định là học viên
        ]);

        return redirect('/login');
    }

    // Hiển thị form đăng nhập
    public function login()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function handleLogin(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            $request->session()->regenerate();
        }

        return back()->with('error', 'Sai email hoặc mật khẩu');
    }

    // Đăng xuất
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
