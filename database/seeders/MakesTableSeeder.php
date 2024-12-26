<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Make; // تحديد النموذج المراد ��نشا��ه
use App\Models\Product; // تحديد النموذج المراد ��نشا��ه

use Illuminate\Support\Facades\DB; // تأكد من إضافة هذا السطر

class MakesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Make::factory()->count(10)->create();
    }
}
