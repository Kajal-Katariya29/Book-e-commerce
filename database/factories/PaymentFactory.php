<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'session_id' => $this->faker->name(),
            'request' => $this->faker->text(),
            'response' => $this->faker->text(),
            'status' => $this->faker->randomElement(['pending','success','failed'])
        ];
    }
}
