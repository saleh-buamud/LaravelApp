<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'saleh',
            'email' => 'saleh@gmail.com',
            'password' => Hash::make('password'),
            'phone_number' => '0923078164',
    ]);
DB::table('users')->insert([
    'name' => 'ali',
    'email' => 'ali@gmail.com',
    'password' => Hash::make('password'),
    'phone_number' => '0914208033',
]);






    }
}
