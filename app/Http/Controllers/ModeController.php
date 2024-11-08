<?php

namespace App\Http\Controllers;

use App\Models\Mode;
use App\Models\Make;
use Illuminate\Http\Request;

class ModeController extends Controller
{
    // عرض جميع الـ Modes
    public function index()
    {
        $modes = Mode::all();
        return view('mode.index', compact('modes'));
    }

    // عرض النموذج لإنشاء Mode جديد
    public function create()
    {
        $makes = Make::all(); // جلب جميع الـ Makes لاختيارها عند إنشاء Mode جديد
        return view('mode.create', compact('makes'));
    }

    // تخزين Mode جديد في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'make_id' => 'required|exists:makes,id',
        ]);

        Mode::create($request->all());
        return redirect()->route('modes.index');
    }

    // عرض تفاصيل Mode معينة
    public function show(Mode $mode)
    {
        return view('mode.show', compact('mode'));
    }

    // عرض النموذج لتحرير Mode
    public function edit(Mode $mode)
    {
        $makes = Make::all(); // جلب جميع الـ Makes لاختيارها عند تحرير Mode
        return view('modes.edit', compact('mode', 'makes'));
    }

    // تحديث Mode معينة
    public function update(Request $request, Mode $mode)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'make_id' => 'required|exists:makes,id',
        ]);

        $mode->update($request->all());
        return redirect()->route('modes.index');
    }

    // حذف Mode معينة
    public function destroy(Mode $mode)
    {
        $mode->delete();
        return redirect()->route('modes.index');
    }
}
