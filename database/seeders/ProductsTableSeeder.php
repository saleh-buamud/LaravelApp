<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // تأكد من إضافة هذا السطر

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([['name' => 'محرك تويوتا', 'sub_category_id' => 1, 'description' => 'محرك قوي', 'price' => 2000.0, 'quantity' => 5], ['name' => 'بطارية هوندا', 'sub_category_id' => 3, 'description' => 'بطارية جديدة', 'price' => 150.0, 'quantity' => 10]]);

        //
    }
}
