<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FoodNutrientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'food_id' => $this->faker->unique()->numberBetween(1, 100),
            'food_serving_size_id' => $this->faker->numberBetween(1, 3),
            'calories' => $this->faker->numberBetween(1, 1000),
            'fat' => $this->faker->numberBetween(1, 100),
            'carbohydrates' => $this->faker->numberBetween(1, 100),
            'protein' => $this->faker->numberBetween(1, 100),
        ];
    }
}
