<?php

namespace App\Actions\FoodGroup;

use App\Models\FoodGroup;
use Illuminate\Http\Request;
use App\Http\Resources\v1\FoodGroup\FoodGroupCollection;

class GetFoodGroupsAction
{
    /**
     * Get all food groups.
     *
     * @return \App\Http\Resources\v1\FoodGroup\FoodGroupCollection
     */
    public function execute(Request $request): FoodGroupCollection
    {
        $foodGroups = FoodGroup::withCount('foods')->get();

        return new FoodGroupCollection($foodGroups);
    }
}
