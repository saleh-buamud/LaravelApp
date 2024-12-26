<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mode; // تحديد موديل الوحدات المتعلقة بالوضعات
use Illuminate\Support\Facades\DB; // تأكد من إضافة هذا السطر

class ModesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Mode::factory()->count(10)->create();
    }
}
