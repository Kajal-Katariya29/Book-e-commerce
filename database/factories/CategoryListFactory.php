<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CategoryList;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryList>
 */
class CategoryListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'category_parent_id' => $this->faker->randomElement(CategoryList::all()->pluck('cateogery_id')),
            'category_name' => $this->faker->name(),
        ];
    }
}
