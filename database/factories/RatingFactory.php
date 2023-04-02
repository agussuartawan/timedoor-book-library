<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $books = Book::pluck('id')->toArray();
        return [
            'id' => fake()->uuid(),
            'rating' => fake()->randomFloat(1, 1, 10),
            'book_id' => fake()->randomElement($books)
        ];
    }
}
