<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(), // افتراضياً يتم إنشاء مستخدم وهمي
            'order_date' => $this->faker->date(), // تاريخ تحتوي على الحد الأقصى اليوم والحد الأدنى اليوم الحالي
            'total_amount' => $this->faker->randomFloat(2, 10, 1000), // عدد عشري تحتوي على الحد الأقصى 1000 والحد الأدنى 10
            'status' => $this->faker->boolean, // افترا��يا�� يتم ��نشا�� حالة فعليا��
        ];
    }
}
