<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Mode;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mode>
 */
class ModeFactory extends Factory
{
    protected $model = Mode::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'make_id' => \App\Models\Make::factory(),
            'name' => $this->faker->word, // استخدام كلمة وهمية
        ];
    }
}
