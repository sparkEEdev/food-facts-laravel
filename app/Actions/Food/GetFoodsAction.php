<?php

namespace App\Actions\Food;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Resources\v1\Food\FoodCollection;

class GetFoodsAction
{
    /**
     * Get all food groups.
     *
     * @return \App\Http\Resources\v1\Food\FoodCollection
     */
    public function execute(Request $request): FoodCollection
    {
        $foods = Food::when($request->get('group_id', false), function($query) use ($request) {
                $query->where('food_group_id', $request->get('group_id'));
            })
            ->paginate($request->get('per_page', 10));

        return new FoodCollection($foods);
    }
}
