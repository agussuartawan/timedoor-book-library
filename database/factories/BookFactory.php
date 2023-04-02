<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $authors = Author::pluck('id')->toArray();
        $categories = Category::pluck('id')->toArray();
        return [
            'id' => fake()->uuid(),
            'title' => fake()->name(),
            'description' => fake()->text(),
            'author_id' => fake()->randomElement($authors),
            'category_id' => fake()->randomElement($categories)
        ];
    }
}
