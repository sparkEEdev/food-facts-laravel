<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\Food\GetFoodsAction;
use App\Actions\Food\ShowFoodAction;
use App\Http\Requests\v1\Food\UpdateFoodRequest;
use App\Actions\Food\UpdateFoodAction;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\v1\Food\FoodCollection
     */
    public function index(Request $request, GetFoodsAction $getFoods)
    {
        return $getFoods->execute($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @param  \App\Actions\Food\ShowFoodAction  $showFoodAction
     * @return \App\Http\Resources\v1\Food\FoodResource
     */
    public function show(Request $request, int $id, ShowFoodAction $showFoodAction)
    {
        return $showFoodAction->execute($request, $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit(Food $food)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $food
     * @param  \App\Actions\Food\UpdateFoodAction  $updateFoodAction
     * @return \App\Http\Resources\v1\Food\FoodResource
     */
    public function update(UpdateFoodRequest $request, int $id, UpdateFoodAction $updateFoodAction)
    {
        return $updateFoodAction->execute($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        //
    }
}
