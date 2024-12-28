<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
            // Mail::to('bbuamud@gmail.com')->send(new TestMail($products, $lowStockProducts));
            Session::flash('messages', 'There are products with less than 5 in stock!');
        }

        return view('dashboard.categories.index', compact('products', 'lowStockProducts'));
    }
}
