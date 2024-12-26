<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductMode; // ��ضافة موديل ��ديد ��لى ملفات الرمز الخا��ة بك
use Illuminate\Support\Facades\Schema; // تأكد من ��ضافة هذا السطر
use Illuminate\Database\Eloquent\Factories\Factory; // تأكد من ��ضافة هذا السطر

use Illuminate\Support\Facades\DB; // تأكد من إضافة هذا السطر

class ProductModelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ProductMode::factory()->count(10)->create();
    }
}
