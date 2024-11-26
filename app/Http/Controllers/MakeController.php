<?php

namespace App\Http\Controllers;

use App\Models\Make;
use Illuminate\Http\Request;

class MakeController extends Controller
{
    // عرض جميع الـ Makes
    public function index()
    {
        $makes = Make::all();
        return view('make.index', compact('makes'));
    }

    // عرض النموذج لإنشاء Make جديد
    public function create()
    {
        return view('make.create');
    }

    // تخزين Make جديد في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Make::create($request->all());
        return redirect()->route('dashboard.makes.index');
    }

    // عرض تفاصيل Make معينة
    public function show(Make $make)
    {
        return view('make.show', compact('make'));
    }

    // عرض النموذج لتحرير Make
    public function edit(Make $make)
    {
        return view('make.edit', compact('make'));
    }

    // تحديث Make معينة
    public function update(Request $request, Make $make)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $make->update($request->all());
        return redirect()->route('dashboard.makes.index');
    }

    // حذف Make معينة
    public function destroy(Make $make)
    {
        $make->delete();
        return redirect()->route('dashboard.makes.index');
    }
}
