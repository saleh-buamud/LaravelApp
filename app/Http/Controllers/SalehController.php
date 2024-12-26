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
            // جلب جميع السُب كاتجوري
            $subCategories = $category->subCategories()->get();
        }

        return view('dashboard.categories.Internal', compact('subCategories', 'categoryName'));
    }

    public function externalParts()
    {
        $category = Category::where('name', 'External-Parts')->first();
        $categoryName = 'External-Parts';

        if ($category) {
            // جلب جميع السُب كاتجوري
            $subCategories = $category->subCategories()->get();
        }

        return view('dashboard.categories.External', compact('subCategories', 'categoryName'));
    }

    public function electricalParts()
    {
        $category = Category::where('name', 'Electrical-Parts')->first();
        $categoryName = 'Electrical-Parts';

        if ($category) {
            // جلب جميع السُب كاتجوري
            $subCategories = $category->subCategories()->get();
        }

        return view('dashboard.categories.Electrical', compact('subCategories', 'categoryName'));
    }
    public function allProducts()
    {
        $products = Product::paginate(1);
        $lowStockProducts = Product::where('quantity', '<', 5)->get();

        return view('dashboard.categories.productAll', compact('products', 'lowStockProducts'));
    }
}
