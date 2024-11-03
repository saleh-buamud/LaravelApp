<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Storage;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = SubCategory::with('category')->get();

        // جلب المنتجات ذات الكميات المنخفضة
        $lowStockProducts = Product::where('quantity', '<', 5)->get();

        return view('dashboard.categories.index', compact('subCategories', 'lowStockProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $perants = Category::all();
        return view('dashboard.categories.create', compact('perants'));
    }
    /**
     * Store a newly created resource in storage.
     */
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

        $data = $request->except('image'); // استثني حقل الصورة
        $data['image'] = $this->uploadImage($request); // تحميل الصورة

        Product::create($data); // إنشاء المنتج
        return redirect()->route('dashboard')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $perants = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')->orwhere('parent_id', '<>', $id);
            })
            ->get();

        return view('dashboard.categories.edit', compact('category', 'perants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $oldImage = $category->image;

        // تمرير قيمة oldImage للتحقق مما إذا كانت الصورة موجودة بالفعل
        $request->validate(Category::rules($id, $oldImage));

        $data = $request->except('image');

        // تحميل الصورة الجديدة إن وجدت
        $newImage = $this->uploadImag($request);
        if ($newImage) {
            $data['image'] = $newImage;
        }

        // تحديث البيانات
        $category->update($data);

        // حذف الصورة القديمة إذا كانت مختلفة عن الصورة الجديدة
        if ($newImage && $oldImage && $oldImage !== $newImage) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()->route('categories.index')->with('updated', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('Deleted', 'Category deleted successfully');
    }
    protected function uploadImag(Request $request)
    {
        if (!$request->hasFile('image')) {
            return null;
        }

        $file = $request->file('image');
        $path = $file->store('img', 'public');
        return $path;
    }
}
