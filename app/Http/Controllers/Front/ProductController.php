<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
class ProductController extends Controller
{
    public function AllProduct()
    {
        $products = Product::with('SubCategory')->limit(4)->get(); // جلب أول 4 قطع غيار مع الفئات الفرعية المرتبطة

        return view('front-ecom-temp.Trending-product', compact('products'));
    }
    public function allInternal()
    {
        $subCategories = SubCategory::whereHas('category', function ($query) {
            $query->where('name', 'Internal-Parts');
        })->get();

        $products = Product::whereIn('sub_category_id', $subCategories->pluck('id'))->get();
        return view('front-ecom-temp.Internal', compact('products'));
    }
    public function allExternal()
    {
        $subCategories = SubCategory::whereHas('category', function ($query) {
            $query->where('name', 'External-Parts');
        })->get();
        $products = Product::whereIn('sub_category_id', $subCategories->pluck('id'))->get();
        return view('front-ecom-temp.External', compact('products'));
    }
    public function allElectrical()
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
        return view('front-ecom-temp.Electrical', compact('products'));
    }
    public function search(Request $request)
    {
        $searchQuery = $request->input('search');

        $products = Product::where('name', 'like', '%' . $searchQuery . '%')->get();

        return response()->json(['results' => $products]);
    }
}
