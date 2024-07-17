<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index', ['categories' => $categories]);
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
        // dd($request->all());
        $request->validate(Category::rules());
        $request->merge([
            'slug' => Str::slug($request->name),
        ]);

        $data = $request->except('image');
        $data['image'] = $this->uploadImag($request);
        $category = new Category($data);
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Category created successfully');
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

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
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
