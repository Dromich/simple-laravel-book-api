<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the model that this factory is for.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'publisher' => $this->faker->company,
            'genre' => $this->faker->word,
            'publication' => $this->faker->date,
            'word_count' => $this->faker->numberBetween(1000, 10000),
            'price' => round($this->faker->randomFloat(2, 2, 50), 2)
        ];
    }
}
