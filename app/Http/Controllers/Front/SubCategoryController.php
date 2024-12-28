<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function AllProduct()
    {
        // جلب أول قطعتين فقط من الفئات الفرعية المرتبطة بالفئات الرئيسية
        $subCategories = SubCategory::with('category')->paginate(10);

        return view('front-ecom-temp.Trending-product', compact('subCategories'));
    }

    public function allInternal()
    {
        // جلب الفئات الفرعية المرتبطة بالفئة الرئيسية 'Internal-Parts'
        $subCategories = SubCategory::whereHas('category', function ($query) {
            $query->where('name', 'Internal-Parts');
        })
            ->with('category')
            ->paginate(1);

        return view('front-ecom-temp.Internal', compact('subCategories'));
    }

    public function allExternal()
    {
        // جلب الفئات الفرعية المرتبطة بالفئة الرئيسية 'External-Parts'
        $subCategories = SubCategory::whereHas('category', function ($query) {
            $query->where('name', 'External-Parts');
        })
            ->with('category')
            ->paginate(1);

        return view('front-ecom-temp.External', compact('subCategories'));
    }

    public function allElectrical()
    {
        // جلب الفئات الفرعية المرتبطة بالفئة الرئيسية 'Electrical-Parts'
        $subCategories = SubCategory::whereHas('category', function ($query) {
            $query->where('name', 'Electrical-Parts');
        })
            ->with('category')
            ->paginate(1);

        return view('front-ecom-temp.Electrical', compact('subCategories'));
    }
}
