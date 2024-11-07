<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    // عرض جميع الفئات الفرعية
    public function index()
    {
        $subCategories = SubCategory::with('category')->get();

        // جلب المنتجات ذات الكميات المنخفضة
        $lowStockProducts = Product::where('quantity', '<', 5)->get();

        return view('dashboard.categories.index', compact('subCategories', 'lowStockProducts'));
    }

    // عرض نموذج إنشاء فئة فرعية جديدة
    public function create()
    {
        $categories = Category::all(); // جلب جميع الفئات
        return view('dashboard.categories.create', compact('categories'));
    }

    // تخزين فئة فرعية جديدة
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        SubCategory::create($request->all());
        return redirect()->route('subcategories.index')->with('success', 'تم إنشاء الفئة الفرعية بنجاح.');
    }

    // عرض نموذج تعديل فئة فرعية
    public function edit(Request $request, SubCategory $subCategory, string $id)
    {
        // جلب الفئات الرئيسية
        $subCategory = SubCategory::find($id);
        $categories = Category::all();
        // إعادة عرض الصفحة مع إرسال الفئة الفرعية والفئات الرئيسية
        return view('dashboard.categories.edit', compact('subCategory', 'categories'));
    }

    // تحديث فئة فرعية معينة
    public function update(Request $request, SubCategory $subCategory, string $id)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id', // التأكد أن الـ category_id موجود في الجدول
        ]);
        $subCategory = SubCategory::find($id);
        // تحديث بيانات الفئة الفرعية
        $subCategory->update($request->all());

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('subcategories.index')->with('updated', 'تم تحديث الفئة الفرعية بنجاح.');
    }

    // حذف فئة فرعية معينة
    public function destroy($id)
    {
        // العثور على الفئة الفرعية باستخدام الـ id
        $subCategory = SubCategory::find($id);

        // التأكد إذا كانت الفئة الفرعية موجودة
        if (!$subCategory) {
            return redirect()->route('subcategories.index')->with('Deleted', 'الفئة الفرعية غير موجودة.');
        }

        // إذا كانت الفئة الفرعية موجودة، قم بحذفها
        $subCategory->delete();

        // إعادة التوجيه مع رسالة النجاح
        return redirect()->route('subcategories.index')->with('Deleted', 'تم حذف الفئة الفرعية بنجاح.');
    }
}
