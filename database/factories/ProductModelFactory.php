<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductModel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductModel>
 */
class ProductModelFactory extends Factory
{
    protected $model = ProductModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word, // اسم الموديل الوهمي
            'description' => $this->faker->sentence, // وصف الموديل الوهمي
            'product_id' => \App\Models\Product::factory(), // افتراضياً يتم إنشاء منتج وهمي
        ];
    }
}
