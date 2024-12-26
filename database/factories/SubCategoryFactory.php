<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SubCategory;
use App\Models\Category; // تأكد من استيراد Category

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    protected $model = SubCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word, // اسم الفئة الفرعية الوهمي
            'description' => $this->faker->sentence, // وصف الفئة الفرعية الوهمي
            'category_id' => Category::factory(), // افتراضياً يتم إنشاء فئة وهمية
        ];
    }
}
