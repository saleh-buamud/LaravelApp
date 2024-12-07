<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    // شاشة تسجيل الدخول
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // معالجة تسجيل الدخول
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    // شاشة التسجيل
    public function showRegisterForm()
    {
        return view('admin.register');
    }

    // معالجة التسجيل
    public function register(Request $request)
    {
        // التحقق من البيانات المدخلة
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6',
            'phone' => 'required|digits_between:10,15', // التحقق من رقم الهاتف
        ]);

        // إنشاء سجل جديد في جدول Admin
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone, // استخدام اسم الحقل في الفورم
        ]);

        // إعادة التوجيه إلى صفحة تسجيل الدخول مع رسالة نجاح
        return redirect()->route('admin.login')->with('success', 'Registration successful.');
    }

    // تسجيل الخروج
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
