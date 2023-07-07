<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'order_date' => $this->faker->date,
            'total_amount' => $this->faker->numberBetween(1,500),
            'payment_type' => $this->faker->name(),
            'payment_status' => $this->faker->name()
        ];
    }
}
