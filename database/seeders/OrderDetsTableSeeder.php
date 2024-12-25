<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // تأكد من إدخال طلب أولًا
        $orderId = DB::table('orders')->insertGetId([
            'user_id' => 1, // تأكد من وجود المستخدم في جدول users
            'order_date' => now(),
            'total_amount' => 2150.0,
            'status' => true,
        ]);

        // إدخال تفاصيل الطلب
        DB::table('order_dets')->insert([['order_id' => $orderId, 'product_id' => 1, 'price' => 2000, 'quantity' => 10], ['order_id' => $orderId, 'product_id' => 2, 'price' => 150, 'quantity' => 70], ['order_id' => $orderId, 'product_id' => 2, 'price' => 950, 'quantity' => 30], ['order_id' => $orderId, 'product_id' => 2, 'price' => 450, 'quantity' => 20]]);
    }
}
