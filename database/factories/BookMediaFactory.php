<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BookList;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookMedia>
 */
class BookMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'media_name' => $this->faker->name(),
        ];
    }
}
