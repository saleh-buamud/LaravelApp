<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'sub_category_id' => \App\Models\SubCategory::factory(),
            'description' => $this->faker->sentence, // وصف المنتج الوهمي
            'image' => $this->faker->image('public/storage/products', 640, 480, null, false), // رابط الصورة الوهمي
            'price' => $this->faker->randomFloat(2, 10, 200), // سعر وهمي بين 10 و 200
            'quantity' => $this->faker->numberBetween(1, 100), // كمية وهمية بين 1 و 100
        ];
    }
}
