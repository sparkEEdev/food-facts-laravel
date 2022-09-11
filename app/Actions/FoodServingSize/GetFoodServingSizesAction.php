<?php

namespace App\Actions\FoodServingSize;

use App\Models\FoodServingSize;
use Illuminate\Http\Request;
use App\Http\Resources\v1\FoodServingSize\FoodServingSizeCollection;

class GetFoodServingSizesAction
{
    /**
     * Get all food groups.
     *
     * @return \App\Http\Resources\v1\FoodServingSize\FoodServingSizeCollection
     */
    public function execute(Request $request): FoodServingSizeCollection
    {
        $servingSizes = FoodServingSize::all();

        return new FoodServingSizeCollection($servingSizes);
    }
}
