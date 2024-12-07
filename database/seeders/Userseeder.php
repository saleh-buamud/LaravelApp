<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إدخال بيانات مستخدم إذا لم يكن موجودًا
        DB::table('users')->updateOrInsert(
            ['email' => 'userone@example.com'], // تحقق من وجود البريد الإلكتروني
            [
                'name' => 'User One',
                'email' => 'userone@example.com',
                'password' => bcrypt('password'),
                'phone_number' => '0920000033',
                'is_admin' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );

        // نفس الشيء مع المستخدم الآخر (إذا كان يحتاج إدخال)
        DB::table('users')->updateOrInsert(
            ['email' => 'noor@gmail.com'],
            [
                'name' => 'noor',
                'email' => 'noor@gmail.com',
                'password' => bcrypt('password'),
                'phone_number' => '0920000033',
                'is_admin' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );
    }
}
