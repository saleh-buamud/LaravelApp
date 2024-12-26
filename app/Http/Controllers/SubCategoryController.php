<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    // Display all subcategories
    public function index()
    {
        $this->authorize('is-admin'); // This will check if the user has admin access

        $subCategories = SubCategory::with('category')->get();

        // Fetch products with low stock
        $lowStockProducts = Product::where('quantity', '<', 5)->get();

        return view('dashboard.categories.index', compact('subCategories', 'lowStockProducts'));
    }

    // Show the form for creating a new subcategory
    public function create()
    {
        $this->authorize('is-admin'); // This will check if the user has admin access

        $categories = Category::all(); // Fetch all categories
        return view('dashboard.categories.create', compact('categories'));
    }

    // Store a newly created subcategory
    public function store(Request $request)
    {
        $this->authorize('is-admin'); // This will check if the user has admin access

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Create a new subcategory
        SubCategory::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('dashboard.index')->with('message', 'Subcategory created successfully.');
    }

    // Show the form for editing the specified subcategory
    public function edit(Request $request, SubCategory $subCategory, string $id)
    {
        $this->authorize('is-admin'); // This will check if the user has admin access

        // Fetch the subcategory and categories
        $subCategory = SubCategory::find($id);
        $categories = Category::all();
        // Return the edit view with subcategory and categories data
        return view('dashboard.categories.edit', compact('subCategory', 'categories'));
    }

    // Update the specified subcategory
    public function update(Request $request, SubCategory $subCategory, string $id)
    {
        $this->authorize('is-admin'); // This will check if the user has admin access

        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id', // Ensure the category_id exists in the categories table
        ]);

        $subCategory = SubCategory::find($id);

        // Update the subcategory
        $subCategory->update($request->all());

        // Redirect with success message
        return redirect()->route('dashboard.index')->with('updated', 'Subcategory updated successfully.');
    }

    // Remove the specified subcategory
    public function destroy($id)
    {
        $this->authorize('is-admin'); // This will check if the user has admin access

        // Find the subcategory by id
        $subCategory = SubCategory::find($id);

        // Check if the subcategory exists
        if (!$subCategory) {
            return redirect()->route('dashboard.index')->with('Deleted', 'Subcategory not found.');
        }

        // Delete the subcategory if it exists
        $subCategory->delete();

        // Redirect with success message
        return redirect()->route('dashboard.index')->with('Deleted', 'Subcategory deleted successfully.');
    }
}
