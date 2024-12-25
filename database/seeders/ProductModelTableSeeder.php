<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // تأكد من إضافة هذا السطر

class ProductModelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('product_model')->insert([['mode_id' => 1, 'product_id' => 1], ['mode_id' => 2, 'product_id' => 2], ['mode_id' => 3, 'product_id' => 3], ['mode_id' => 4, 'product_id' => 4]]);
    }
}
