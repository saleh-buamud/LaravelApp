<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderDet;
use Illuminate\Support\Facades\DB;

class OrderDetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderDet::factory()->count(10)->create();
    }
}
