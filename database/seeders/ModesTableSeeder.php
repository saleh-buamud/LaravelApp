<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // تأكد من إضافة هذا السطر


class ModesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         DB::table('modes')->insert([
            ['name' => 'Camry', 'make_id' => 1],
            ['name' => 'Civic', 'make_id' => 2],
            ['name' => 'Focus', 'make_id' => 3],
        ]);
    }
}
