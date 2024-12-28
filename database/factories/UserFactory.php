<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name, // اسم المستخدم الوهمي
            'email' => $this->faker->unique()->safeEmail, // بريد إلكتروني وهمي وفريد
            'email_verified_at' => now(), // تاريخ التحقق من البريد الإلكتروني
            'password' => Hash::make('password'), // كلمة مرور مشفرة (ثابتة لغرض الاختبار)
            'remember_token' => Str::random(10), // رمز التذكر
        ];
    }
}
