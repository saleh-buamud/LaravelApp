<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductMode;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductMode>
 */
class ProductModeFactory extends Factory
{
    protected $model = ProductMode::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => \App\Models\Product::factory(), // افتراضياً يتم إنشاء منتج وهمي
            'mode_id' => \App\Models\Mode::factory(), // افتراضياً يتم إنشاء وضع وهمي
        ];
    }
}
