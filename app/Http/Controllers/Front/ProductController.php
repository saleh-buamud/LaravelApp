<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function showProductsBySubCategory($subCategoryId)
    {
        // جلب الفئة الفرعية مع المنتجات المرتبطة بها باستخدام Eager Loading
        $subCategory = SubCategory::with('products')->find($subCategoryId);
        $products = $subCategory->products;
        if (!$subCategory || !$products) {
            return redirect()->route('home');
        }
        return view('front-ecom-temp.products', compact('subCategory', 'products'));
    }
}
