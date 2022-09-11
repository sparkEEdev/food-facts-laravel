<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Models\FoodServingSize;
use App\Http\Controllers\Controller;
use App\Actions\FoodServingSize\GetFoodServingSizesAction;

class FoodServingSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\v1\FoodServingSize\FoodServingSizeCollection
     */
    public function index(Request $request, GetFoodServingSizesAction $getFoodServingSizes)
    {
        return $getFoodServingSizes->execute($request);
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
     * @param  \App\Models\FoodServingSize  $foodServingSize
     * @return \Illuminate\Http\Response
     */
    public function show(FoodServingSize $foodServingSize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FoodServingSize  $foodServingSize
     * @return \Illuminate\Http\Response
     */
    public function edit(FoodServingSize $foodServingSize)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FoodServingSize  $foodServingSize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FoodServingSize $foodServingSize)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FoodServingSize  $foodServingSize
     * @return \Illuminate\Http\Response
     */
    public function destroy(FoodServingSize $foodServingSize)
    {
        //
    }
}
