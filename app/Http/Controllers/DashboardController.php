<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Session; // Make sure to import Session

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $lowStockProducts = Product::where('quantity', '<', 5)->get();

        // If there are products with quantity less than 5
        if ($lowStockProducts->count() > 0) {
            // Add a message to the session
            Session::flash('messages', 'There are products with less than 5 in stock!');
        }

        return view('dashboard.categories.index', compact('products', 'lowStockProducts'));
    }
}
