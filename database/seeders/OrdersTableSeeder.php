<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // تأكد من إضافة هذا السطر

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         DB::table('orders')->insert([
            ['user_id' => 1, 'order_date' => now(), 'total_amount' => 2150.00, 'status' => true],
        ]);
    }
}
