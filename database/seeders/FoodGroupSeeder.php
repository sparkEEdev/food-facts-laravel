<?php

namespace Database\Seeders;

use App\Models\FoodGroup;
use Illuminate\Database\Seeder;

class FoodGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FoodGroup::factory()
            ->count(50)
            ->create();
    }
}
