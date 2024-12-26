<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;

class ProductController extends Controller
{
    public function AllProduct()
    {
        // جلب أول قطعتين فقط من جميع المنتجات مع الفئات الفرعية
        $products = Product::with('SubCategory')->take(2)->get();

        return view('front-ecom-temp.Trending-product', compact('products'));
    }

    public function allInternal()
    {
        // جلب أول قطعتين فقط من المنتجات الداخلية باستخدام SubCategory (على فرض أن الفئة الداخلية لها sub_category_id = 1)
        $products = Product::whereHas('SubCategory', function ($query) {
            $query->where('id', 1); // استبدل 1 بـ ID الفئة الفرعية الداخلية
        })
            ->take(2)
            ->get();
        dd($products);

        return view('front-ecom-temp.Internal', compact('products'));
    }

    public function allExternal()
    {
        // جلب أول قطعتين فقط من المنتجات الخارجية باستخدام SubCategory (على فرض أن الفئة الخارجية لها sub_category_id = 2)
        $products = Product::whereHas('SubCategory', function ($query) {
            $query->where('id', 2); // استبدل 2 بـ ID الفئة الفرعية الخارجية
        })
            ->take(2)
            ->get();
        dd($products);

        return view('front-ecom-temp.External', compact('products'));
    }

    public function allElectrical()
    {
        // جلب أول قطعتين فقط من المنتجات الكهربائية باستخدام SubCategory (على فرض أن الفئة الكهربائية لها sub_category_id = 3)
        $products = Product::whereHas('SubCategory', function ($query) {
            $query->where('id', 3); // استبدل 3 بـ ID الفئة الفرعية الكهربائية
        })
            ->take(2)
            ->get();
        dd($products);

        return view('front-ecom-temp.Electrical', compact('products'));
    }

    public function search(Request $request)
    {
        // جلب المنتجات بناءً على الكلمة المدخلة في خانة البحث
        $searchTerm = $request->get('search');

        $products = Product::when($searchTerm, function ($query) use ($searchTerm) {
            return $query->where('name', 'like', '%' . $searchTerm . '%')->orWhere('description', 'like', '%' . $searchTerm . '%');
        })
            ->take(2)
            ->get(); // جلب قطعتين فقط بناءً على البحث

        // إرجاع العرض مع المنتجات
        return view('product.search', compact('products'));
    }
}
