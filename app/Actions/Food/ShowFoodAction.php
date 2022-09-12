<?php

namespace App\Actions\Food;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Resources\v1\Food\FoodCollection;
use App\Http\Resources\v1\Food\FoodResource;

class ShowFoodAction
{
    /**
     * Get all food groups.
     *
     * @return \App\Http\Resources\v1\Food\FoodResource
     */
    public function execute(Request $request, int $id): FoodResource
    {
        $food = Food::with(['nutrients.serving_size'])
            ->find($id);

        return new FoodResource($food);
    }
}
