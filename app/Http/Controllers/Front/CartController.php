<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Carbon\Carbon; // استيراد Carbon بشكل صحيح
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\SubCategory; // ��ضافة SubCategory Model
use App\Models\Product; // ��ضافة Product Model
use App\Mail\TestMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
            'user_id' => auth()->check() ? auth()->user()->id : null,
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
        return back()->with('success', 'تم حذف جميع منتجات في السلة');
    }
    public function saveOrder(Request $request)
    {
        if (\Cart::isEmpty()) {
            return redirect()->route('cart')->with('error', 'There is no item in your cart');
        }
        if (Auth::guest()) {
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول أولاً للمتابعة');
        }

        // إنشاء سجل طلب جديد
        $order = new Order();
        $order->user_id = auth()->check() ? auth()->user()->id : null; // ربط الطلب بالمستخدم إذا كان مسجلاً للدخول، وإذا لم يكن يوجد مستخدم يتم تعيين القيمة null
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

            // تحديث كمية المنتج في المخزون
            $product = Product::find($item->id);
            if ($product) {
                $product->quantity -= $item->quantity;
                $product->save();
            }

            // إضافة تفاصيل الطلب إلى المصفوفة
            $orderDetails[] = $orderDetail;
        }

        // إرسال البريد الإلكتروني للزبون مع تفاصيل الطلب
        Mail::to('itstd.4626@uob.edu.ly')->send(new TestMail($order, $orderDetails));
        // إرسال البريد الإلكتروني لصاحب المتجر مع تفاصيل الطلب
        Mail::to('buamudsaleh@gmail.com')->send(new TestMail($order, $orderDetails));

        // مسح السلة بعد حفظ الطلب
        \Cart::clear();

        // إعادة التوجيه بعد حفظ الطلب
        return redirect()->route('home')->with('success', 'Your order has been placed successfully!');
    }
}
