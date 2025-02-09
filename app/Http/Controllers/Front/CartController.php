<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Carbon\Carbon; // Import Carbon for date management
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart; // Import Cart library
use App\Models\SubCategory; // Import SubCategory model
use App\Models\Product; // Import Product model
use App\Mail\TestMail; // Import TestMail for email notifications
use Illuminate\Support\Facades\Auth; // Import Auth for authentication
use Illuminate\Support\Facades\Mail; // Import Mail for sending emails
use App\Models\Order; // Import Order model
use App\Models\OrderDet; // Import Order Details model

class CartController extends Controller
{
    // Display the contents of the cart
    public function cart()
    {
        $total = \Cart::getTotal(); // Get the total price of the cart
        $items = \Cart::getContent(); // Get the items in the cart
        return view('front-ecom-temp.cart', compact('items', 'total')); // Return the cart view with data
    }

    // Add a product to the cart
    public function addCart($productId, Request $request)
    {
        $product = Product::findOrFail($productId); // Find the product by ID

        // Add the product to the cart
        \Cart::add([
            'user_id' => auth()->check() ? auth()->user()->id : null, // Associate the product with the user if logged in
            'id' => $productId, // Product ID
            'name' => $product->name, // Product name
            'price' => $product->price, // Product price
            'quantity' => 1, // Default quantity is 1
            'attributes' => [
                'image' => $product->image, // Product image
            ],
            'associatedModel' => $product, // Associate the product with its model
        ]);

        // If the request is AJAX, return a JSON response
        if ($request->ajax()) {
            return response()->json(['totalQuantity' => Cart::getTotalQuantity()]);
        } else {
            // If not AJAX, redirect back with a success message
            return redirect()->back()->with('success', 'Item has been added to the cart');
        }
    }

    // Increase the quantity of a product in the cart
    public function addQuantity($productId)
    {
        \Cart::update($productId, [
            'quantity' => +1, // Increase quantity by 1
        ]);

        return back()->with('success', 'Quantity has been increased');
    }

    // Decrease the quantity of a product in the cart
    public function decreaseQuantity($productId)
    {
        \Cart::update($productId, [
            'quantity' => -1, // Decrease quantity by 1
        ]);

        return back()->with('success', 'Item quantity has been decreased');
    }

    // Remove a product from the cart
    public function removeItem($productId)
    {
        \Cart::remove($productId); // Remove the product from the cart
        return back()->with('success', 'Item has been removed from the cart');
    }

    // Clear the entire cart
    public function clearCart()
    {
        \Cart::clear(); // Clear all items from the cart
        return back()->with('success', 'All items have been removed from the cart');
    }

    // Save the order to the database
    public function saveOrder(Request $request)
    {
        // Check if the cart is empty
        if (\Cart::isEmpty()) {
            return redirect()->route('cart')->with('error', 'There are no items in your cart');
        }

        // Check if the user is logged in
        if (Auth::guest()) {
            return redirect()->route('login')->with('error', 'You must log in to proceed');
        }

        // Create a new order record
        $order = new Order();
        $order->user_id = auth()->check() ? auth()->user()->id : null; // Associate the order with the user if logged in
        $order->order_date = Carbon::now(); // Set the current order date
        $order->total_amount = \Cart::getTotal(); // Calculate the total amount using getTotal()
        $order->status = 1; // Set the order status to "Pending" by default
        // Save the order to the database
        $order->save();

        // Add order details to the order_details table
        $orderDetails = [];
        foreach (\Cart::getContent() as $item) {
            $orderDetail = new OrderDet();
            $orderDetail->order_id = $order->id; // Associate details with the order
            $orderDetail->product_id = $item->id; // Product ID
            $orderDetail->quantity = $item->quantity; // Quantity
            $orderDetail->price = $item->price; // Price per product
            $orderDetail->save(); // Save the product details to the order_details table

            // Update the product stock quantity
            $product = Product::find($item->id);
            if ($product) {
                $product->quantity -= $item->quantity; // Decrease the stock quantity
                $product->save();
            }

            // Add order details to the array
            $orderDetails[] = $orderDetail;
        }

        // // Send an email to the customer with order details
        // Mail::to('itstd.4626@uob.edu.ly')->send(new TestMail($order, $orderDetails));
        // // Send an email to the store owner with order details
        // Mail::to('buamudsaleh@gmail.com')->send(new TestMail($order, $orderDetails));

        // Clear the cart after saving the order
        \Cart::clear();

        // Redirect after saving the order
        return redirect()->route('home')->with('success', 'Your order has been placed successfully!');
    }
}
