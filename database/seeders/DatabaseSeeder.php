<?php

namespace Database\Seeders;
use Database\Seeders\SubCategoriesTableSeeder;
use Database\Seeders\MakesTableSeeder;
use Database\Seeders\ModesTableSeeder;
use Database\Seeders\ProductsTableSeeder;
use Database\Seeders\OrdersTableSeeder;
use Database\Seeders\OrderDetsTableSeeder;
use Database\Seeders\ProductModelTableSeeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([SubCategoriesTableSeeder::class, MakesTableSeeder::class, ModesTableSeeder::class, ProductsTableSeeder::class, OrdersTableSeeder::class, OrderDetsTableSeeder::class, ProductModelTableSeeder::class, UserSeeder::class]);
    }
}
