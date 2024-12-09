<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class CartController extends Controller
{
    public function cart()
    {
        $total = \Cart::getTotal();
        $items = \Cart::getContent();
        return view('front-ecom-temp.cart', compact('items', 'total'));
    }

    public function addCart($productId, Request $request)
    {
        $product = Product::findOrFail($productId);

        \Cart::add([
            'id' => $productId,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => [
                'image' => $product->image,
            ],
            'associatedModel' => $product,
        ]);

        if ($request->ajax()) {
            return response()->json(['totalQuantity' => Cart::getTotalQuantity()]);
        } else {
            return redirect()->back()->with('success', 'Item has been added to the cart');
        }
    }

    public function addQuantity($productId)
    {
        \Cart::update($productId, [
            'quantity' => +1,
        ]);

        return back()->with('success', 'Quantity has been increased');
    }

    public function decreaseQuantity($productId)
    {
        \Cart::update($productId, [
            'quantity' => -1,
        ]);

        return back()->with('success', 'item quantity has been decreased');
    }

    public function removeItem($productId)
    {
        \Cart::remove($productId);
        return back()->with('success', 'item has been removed from the cart');
    }

    public function clearCart()
    {
        \Cart::clear();
        return back()->with('success', 'There is no item in your cart');
    }
}
