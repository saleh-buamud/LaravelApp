<?php

namespace App\Http\Controllers;
use App\Mail\LowStockNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\Admin;
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
        // استرجاع جميع المنتجات
        $products = Product::paginate(10); // عرض 10 منتجات في الصفحة

        // استرجاع المنتجات التي تحتوي على كمية أقل من 5
        $lowStockProducts = Product::where('quantity', '<', 5)->get();

        $admins = Admin::all();

        // إرسال بريد إلكتروني لكل مشرف لكل منتج الكمية فيه أقل من 5
        // foreach ($lowStockProducts as $product) {
        //   foreach ($admins as $admin) {
        //Mail::to($admin->email)->send(new LowStockNotification($product));
        // }
        // }
        // إرجاع العرض مع المنتجات
        return view('dashboard.categories.productAll', compact('products', 'lowStockProducts'));
    }
}
