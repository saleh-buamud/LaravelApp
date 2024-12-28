<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // عرض قائمة جميع الإداريين
    public function allAdmin()
    {
        $admins = Admin::paginate(10);
        return view('dashboard.categories.adminAll', compact('admins'));
    }

    // عرض نموذج إنشاء إداري جديد
    public function create()
    {
        return view('admin.create');
    }

    // تخزين إداري جديد في قاعدة البيانات
    public function store(Request $request)
    {
        // تأكد من أن الأدمن الحالي لديه الصلاحية لإنشاء مستخدمين
        if (!auth()->guard('admin')->user()->can_create_users) {
            return redirect()->route('dashboard.allAdmin')->with('error', 'You do not have permission to create users.');
        }

        // التحقق من البيانات المدخلة
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // إنشاء الإداري الجديد
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // تحويل قيمة can_create_users إلى boolean
            'can_create_users' => $request->has('can_create_users') ? true : false,
        ]);

        // إعادة توجيه إلى صفحة جميع الإداريين مع رسالة نجاح
        return redirect()->route('dashboard.allAdmin')->with('success', 'Admin created successfully!');
    }

    // عرض نموذج تعديل الإداري
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    // تحديث معلومات الإداري
    public function update(Request $request, $id)
    {
        // التحقق من البيانات المدخلة
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'is_admin' => 'nullable|boolean',
            'can_create_users' => 'nullable|boolean', // التأكد من أن القيمة هي boolean
        ]);

        // إيجاد الإداري لتحديثه
        $admin = Admin::findOrFail($id);

        // تحديث بيانات الإداري
        $admin->name = $request->name;
        $admin->email = $request->email;

        // إذا تم ملء حقل كلمة المرور
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        // تحديث القيم الخاصة بالـ is_admin و can_create_users
        $admin->is_admin = $request->has('is_admin') ? $request->is_admin : $admin->is_admin;
        $admin->can_create_users = $request->has('can_create_users') ? true : false; // تحويل القيمة إلى boolean

        // حفظ التعديلات
        $admin->save();

        // إعادة توجيه إلى صفحة جميع الإداريين مع رسالة نجاح
        return redirect()->route('dashboard.allAdmin')->with('success', 'Admin updated successfully!');
    }
}
