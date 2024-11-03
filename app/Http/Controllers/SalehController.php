<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\Product;

class SalehController extends Controller
{
    public function internalParts()
    {
        $category = Category::where('name', 'Internal-Parts')->first();
        $categoryName = 'Internal-Parts';

        if ($category) {
            // جلب جميع السُب كاتجوري المرتبطة
            $subCategories = $category->subCategories;
        }

        return view('dashboard.categories.Internal', compact('subCategories', 'categoryName'));
    }

    public function externalParts()
    {
        $category = Category::where('name', 'External-Parts')->first();
        $categoryName = 'External-Parts';

        if ($category) {
            // جلب جميع السُب كاتجوري المرتبطة
            $subCategories = $category->subCategories;
        }

        return view('dashboard.categories.External', compact('subCategories', 'categoryName'));
    }

    public function electricalParts()
    {
        $category = Category::where('name', 'Electrical-Parts')->first();
        $categoryName = 'Electrical-Parts';

        if ($category) {
            // جلب جميع السُب كاتجوري المرتبطة
            $subCategories = $category->subCategories;
        }

        return view('dashboard.categories.Electrical', compact('subCategories', 'categoryName'));
    }

    // دالة لجلب قطع الغيار المرتبطة بالقطع الداخلية
    public function internalPartsProducts()
    {
        $subCategories = SubCategory::whereHas('category', function ($query) {
            $query->where('name', 'Internal-Parts');
        })->get();

        $products = Product::whereIn('sub_category_id', $subCategories->pluck('id'))->get();
        return view('dashboard.categories.AllintPro', compact('products'));
    }

    // دالة لجلب قطع الغيار المرتبطة بالقطع الخارجية
    public function externalPartsProducts()
    {
        $subCategories = SubCategory::whereHas('category', function ($query) {
            $query->where('name', 'External-Parts');
        })->get();

        $products = Product::whereIn('sub_category_id', $subCategories->pluck('id'))->get();

        return view('dashboard.categories.AllExtPro', compact('products'));
    }

    // دالة لجلب قطع الغيار المرتبطة بالكهربائية
    public function electricalPartsProducts()
    {
        $subCategories = SubCategory::whereHas('category', function ($query) {
            $query->where('name', 'Electrical-Parts');
        })->get();

        if ($subCategories->isEmpty()) {
            dd('No subcategories found for Electrical-Parts');
        }

        $products = Product::whereIn('sub_category_id', $subCategories->pluck('id'))->get();

        if ($products->isEmpty()) {
            dd('No products found for the subcategories');
        }

        return view('dashboard.categories.AllelePro', compact('products'));
    }

    public function allProducts()
    {
        $products = Product::all();
        return view('dashboard.categories.productAll', compact('products'));
    }
    // دالة لجلب المنتجات المرتبطة بفئة فرعية معينة
    public function productsBySubCategory($subCategoryId)
    {
        // الحصول على الفئة الفرعية بناءً على المعرف
        $subCategory = SubCategory::find($subCategoryId);

        if (!$subCategory) {
            return redirect()->back()->with('error', 'SubCategory not found.');
        }

        // جلب المنتجات المرتبطة بالفئة الفرعية
        $products = $subCategory->products; // باستخدام العلاقة المعرفة في نموذج SubCategory

        return view('dashboard.categories.productsBySubCategory', compact('products', 'subCategory'));
    }
}
