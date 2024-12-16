<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Carbon\Carbon; // استيراد Carbon بشكل صحيح
use Illuminate\Http\Request;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDet;

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
            'user_id' => auth()->user()->id,
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
    public function saveOrder(Request $request)
    {
        // إنشاء سجل طلب جديد
        $order = new Order();
        $order->user_id = auth()->user()->id; // ربط الطلب بالمستخدم الذي قام بإنشائه
        $order->order_date = Carbon::now(); // تعيين تاريخ الطلب الحالي
        $order->total_amount = \Cart::getTotal(); // حساب المجموع الكلي باستخدام getTotal()
        $order->status = 1; // تعيين حالة الطلب إلى "قيد الانتظار" بشكل افتراضي

        // حفظ الطلب في قاعدة البيانات
        $order->save();

        // إضافة تفاصيل الطلب إلى جدول order_details
        $orderDetails = [];
        foreach (\Cart::getContent() as $item) {
            $orderDetail = new OrderDet();
            $orderDetail->order_id = $order->id; // ربط التفاصيل بالطلب
            $orderDetail->product_id = $item->id; // id من المنتج
            $orderDetail->quantity = $item->quantity; // الكمية
            $orderDetail->price = $item->price; // السعر لكل منتج
            $orderDetail->save(); // حفظ تفاصيل المنتج في جدول order_details

            // إضافة تفاصيل الطلب إلى المصفوفة
            $orderDetails[] = $orderDetail;
        }

        // إرسال البريد الإلكتروني مع تفاصيل الطلب
        // Mail::to(auth()->user()->email)->send(new TestMail($order, $orderDetails));

        Mail::to('buamudb@gmail.com')->send(new TestMail());

        // مسح السلة بعد حفظ الطلب
        \Cart::clear();

        // إعادة التوجيه بعد حفظ الطلب
        return redirect()->route('home')->with('success', 'Your order has been placed successfully!');
    }

    public function send()
    {
        Mail::to('buamudsaleh@gmail.com')->send(new TestMail());
        return 'Email sent ';
    }
}
