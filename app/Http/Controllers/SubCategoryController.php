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
        return redirect()->route('subcategories.index')->with('success', 'SubCategory created successfully.');
    }

    // عرض نموذج تعديل فئة فرعية
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::all();
        return view('dashboard.categories.edit', compact('subCategory', 'categories'));
    }

    // تحديث فئة فرعية معينة
    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subCategory->update($request->all());
        return redirect()->route('subcategories.index')->with('success', 'SubCategory updated successfully.');
    }

    // حذف فئة فرعية معينة
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return redirect()->route('subcategories.index')->with('success', 'SubCategory deleted successfully.');
    }
    // public function check()
    // {
    //     $lowStockProducts = Product::where('quantity', '<', 5)->get();
    // dd($lowStockProducts)
    //     return view('dashboard.categories.index', compact('lowStockProducts'));
    // }
}
