<?php

namespace App\Http\Controllers;

use App\Models\Product; // تأكد من إضافة الـ Model
use App\Models\SubCategory; // إضافة SubCategory Model
use Illuminate\Http\Request;
use App\Models\Mode; // ��ضافة Model Model

class ProductController extends Controller
{
    // عرض نموذج إنشاء منتج جديد
    public function create()
    {
        $subCategories = SubCategory::all(); // جلب جميع الفئات الفرعية
        $models = Mode::all(); // جلب جميع الموديلات

        return view('products.create', compact('subCategories', 'models'));
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
            'model_id' => 'required|array', // إلزام المستخدم باختيار موديلات
            'model_id.*' => 'exists:modes,id', // التحقق من وجود كل موديل
        ]);

        $productData = $request->all();

        // معالجة الصورة
        if ($request->hasFile('image')) {
            // تحديد المسار لحفظ الصورة
            $imagePath = $request->file('image')->storeAs('images/products', $request->file('image')->getClientOriginalName(), 'public');
            $productData['image'] = $imagePath;
        }

        // إنشاء المنتج
        $product = Product::create($productData);

        // ربط المنتج بالموديلات المختارة عبر جدول product_model
        if ($request->has('model_id')) {
            $product->modes()->attach($request->model_id); // استخدام الحقل 'model_id' الذي يحتوي على موديلات
        }

        return redirect()->route('dashboard.allProducts')->with('messages', 'Product created successfully.');
    }

    // عرض نموذج تعديل منتج
    public function edit(Product $product)
    {
        $subCategories = SubCategory::all(); // جلب جميع الفئات الفرعية
        $modes = Mode::all(); // يجب أن تضمن هذا السطر لجلب الموديلات

        return view('products.edit', compact('product', 'subCategories', 'modes'));
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
            'sub_category_id' => 'required|exists:sub_categories,id',
            'mode_id' => 'required|array', // إلزام الموديلات
            'mode_id.*' => 'exists:modes,id',
        ]);

        $productData = $request->all();

        // معالجة الصورة
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($product->image && file_exists(storage_path('app/public/' . $product->image))) {
                unlink(storage_path('app/public/' . $product->image));
            }
            // تحديد المسار لحفظ الصورة
            $imagePath = $request->file('image')->store('products', 'public');
            $productData['image'] = $imagePath;
        }

        // تحديث المنتج
        $product->update($productData);

        // تحديث علاقة الموديلات
        $product->modes()->sync($request->mode_id);

        return redirect()->route('dashboard.allProducts')->with('messages', 'Product updated successfully.');
    }

    public function destroy(string $id)
    {
        // البحث عن المنتج باستخدام الـ ID المحدد
        $product = Product::findOrFail($id);

        // حذف المنتج
        $product->delete();

        // إعادة التوجيه إلى قائمة المنتجات مع رسالة تأكيد
        return redirect()->route('dashboard.allProducts')->with('messages', 'Product deleted successfully');
    }

    public function search(Request $request)
    {
        // Get the search query from the request
        $query = $request->get('name');
        // dd($query);
        // If the query is not empty, filter products by name
        if ($query) {
            $products = Product::where('name', 'like', '%' . $query . '%')->paginate(1);
        } else {
            // If no query is provided, show all products
            $products = Product::paginate(1);
        }

        // Return the view with the filtered products
        return view('dashboard.categories.productAll', compact('products'));
    }
}
