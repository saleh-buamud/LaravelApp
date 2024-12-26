<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OrderDet;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDet>
 */
class OrderDetFactory extends Factory
{
    protected $model = OrderDet::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => \App\Models\Order::factory(), // افتراضياً يتم إنشاء طلب وهمي
            'product_id' => \App\Models\Product::factory(), // افتراضياً يتم إنشاء منتج وهمي
            'quantity' => $this->faker->numberBetween(1, 10), // كمية وهمية بين 1 و 10
            'price' => $this->faker->randomFloat(2, 5, 100), // سعر وهمي بين 5 و 100
            'name' => $this->faker->word, // اسم المنتج الوهمي
            'phone' => $this->faker->unique()->numerify('ORD-#####'),
            'address' => $this->faker->address, // عنوان المنتج الوهمي
            'city' => $this->faker->city, // مدينة المنتج الوهمي
        ];
    }
}
