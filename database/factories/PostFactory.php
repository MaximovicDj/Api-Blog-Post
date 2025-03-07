<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(5, true);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->text(),
            'status' => fake()->boolean(),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
