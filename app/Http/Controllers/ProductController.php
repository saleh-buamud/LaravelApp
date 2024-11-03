<?php

namespace App\Http\Controllers;

use App\Models\Product; // تأكد من إضافة الـ Model
use App\Models\SubCategory; // إضافة SubCategory Model
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // عرض نموذج إنشاء منتج جديد
    public function create()
    {
        $subCategories = SubCategory::all(); // جلب جميع الفئات الفرعية
        return view('products.create', compact('subCategories'));
    }

    // تخزين منتج جديد
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sub_category_id' => 'required|exists:sub_categories,id',
        ]);

        $productData = $request->all();

        // معالجة الصورة
        if ($request->hasFile('image')) {
            // تحديد المسار لحفظ الصورة
            $imagePath = $request->file('image')->storeAs('images/products', $request->file('image')->getClientOriginalName(), 'public');
            $productData['image'] = $imagePath;
        }

        Product::create($productData);
        return redirect()->route('dashboard.allProducts')->with('success', 'Product created successfully.');
    }

    // عرض نموذج تعديل منتج
    public function edit(Product $product)
    {
        $subCategories = SubCategory::all(); // جلب جميع الفئات الفرعية
        return view('products.edit', compact('product', 'subCategories'));
    }

    // تحديث منتج معين
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'subcategory_id' => 'required|exists:sub_categories,id',
        ]);

        $productData = $request->all();

        // معالجة الصورة
        if ($request->hasFile('image')) {
            // هنا يمكنك حذف الصورة القديمة إذا كانت موجودة
            $imagePath = $request->file('image')->store('products', 'public');
            $productData['image'] = $imagePath;
        }

        $product->update($productData);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
}
