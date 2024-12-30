<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Product;

class ProductController extends Controller
{
    public function showProductsBySubCategory($subCategoryId)
    {
        // جلب الفئة الفرعية مع المنتجات المرتبطة بها باستخدام Eager Loading مع Pagination
        $subCategory = SubCategory::find($subCategoryId);

        if (!$subCategory) {
            return redirect()->route('home');
        }

        // جلب المنتجات بطريقة مقسمة (paginate)
        $products = Product::where('sub_category_id', $subCategoryId)->paginate(1); // يمكنك تغيير الرقم 10 حسب رغبتك

        return view('front-ecom-temp.products', compact('subCategory', 'products'));
    }
    public function search(Request $request)
    {
        $keyword = $request->input('search');
        $products = Product::query();
        if ($keyword) {
            $products = $products->search($keyword);
        }

        $products = $products->paginate(1); // يمكنك ضبط العدد حسب احتياجك

        return view('front-ecom-temp.search', compact('products'));
    }
}
