<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FoodServingSize;

class FoodServingSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FoodServingSize::updateOrCreate(
            [
                'measurement' => 'gram'
            ], [
                'name' => '100g',
                'measurement' => 'gram',
                'portion_size' => '100',
            ]
        );

        FoodServingSize::updateOrCreate(
            [
                'measurement' => 'ounce'
            ], [
                'name' => '1 oz',
                'measurement' => 'ounce',
                'portion_size' => '1',
            ]
        );

        FoodServingSize::updateOrCreate(
            [
            'measurement' => 'cup'
        ], [
            'name' => '1 cup',
            'measurement' => 'cup',
            'portion_size' => '1',
            ]
        );
    }
}
