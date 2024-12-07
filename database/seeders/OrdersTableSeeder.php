<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User; // تأكد من إضافة الـ Model

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إضافة مستخدم أولًا
        $user = User::create([
            'name' => 'User One',
            'email' => 'userone@example.com',
            'password' => bcrypt('password'), // تأكد من تشفير كلمة المرور
        ]);

        // إضافة الطلبات
        DB::table('orders')->insert([
            'user_id' => $user->id, // استخدام معرف المستخدم الذي تم إنشاؤه
            'order_date' => now(),
            'total_amount' => 2150.0,
            'status' => true, // قيمة الحالة (يمكنك تخصيص الحالة حسب الحاجة)
        ]);
    }
}
