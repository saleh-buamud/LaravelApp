<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // تأكد من إضافة هذا السطر

class OrderDetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
          DB::table('order_dets')->insert([
            ['order_id' => 1, 'product_id' => 1, 'quantity' => 1, 'price' => 2000.00],
            ['order_id' => 1, 'product_id' => 2, 'quantity' => 1, 'price' => 150.00],
        ]);
    }
}
