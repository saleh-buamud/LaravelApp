<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // تأكد من إضافة هذا السطر

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_categories')->insert([['category_id' => 1, 'name' => 'محركات', 'description' => 'محركات السيارات'], ['category_id' => 1, 'name' => 'عفشة', 'description' => 'أجزاء العفشة للسيارات'], ['category_id' => 2, 'name' => 'أبواب', 'description' => 'أبواب سيارات خارجية'], ['category_id' => 3, 'name' => 'بطاريات', 'description' => 'بطاريات السيارات الكهربائية']]);
    }
}
