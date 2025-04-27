<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Mail\TestMail;
use App\Mail\LowStockNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Session; // Make sure to import Session

class DashboardController extends Controller
{
    public function index()
    {
        $lowStockProducts = Product::where('quantity', '<', 5)->get();
        $products = Product::all();

        if ($lowStockProducts->count() > 0) {
            Mail::to('itstd.4626@uob.edu.ly')->send(new LowStockNotification($lowStockProducts));

            Session::flash('messages', 'There are ' . $lowStockProducts->count() . ' products with low stock!');
        }

        return view('dashboard.categories.index', compact('products', 'lowStockProducts'));
    }
    public function AllProductiNcrease(Request $request)
    {
        $products = Product::paginate(10);

        return view('dashboard.categories.increase-quantity', compact('products'));
    }
    /**
     * Increase the quantity of a product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function increaseQuantity(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'quantity' => 'required|integer|min:1', // Ensure the quantity is a positive integer
        ]);

        // Find the product by ID
        $product = Product::findOrFail($id);

        // Increase the product quantity
        $product->quantity += $request->input('quantity');

        // Save the updated product
        $product->save();

        // Redirect back with a success message
        return redirect()->back()->with('messages', 'تم زيادة الكمية بنجاح');
    }
}
