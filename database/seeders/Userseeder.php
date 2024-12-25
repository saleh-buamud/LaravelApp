<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'User 1',
                'email' => 'user1@example.com',
                'password' => 'password',
                'phone_number' => '0123456789',
                'is_admin' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
