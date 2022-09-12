<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FoodNutrient;

class FoodNutrientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FoodNutrient::factory()
            ->count(100)
            ->create();
    }
}
