<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\FoodGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\FoodGroup\{GetFoodGroupsAction};

class FoodGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\v1\FoodGroup\FoodGroupCollection
     */
    public function index(Request $request, GetFoodGroupsAction $getFoodGroups)
    {
        return $getFoodGroups->execute($request);
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
     * @param  \App\Models\FoodGroup  $foodGroup
     * @return \Illuminate\Http\Response
     */
    public function show(FoodGroup $foodGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FoodGroup  $foodGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(FoodGroup $foodGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FoodGroup  $foodGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FoodGroup $foodGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FoodGroup  $foodGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(FoodGroup $foodGroup)
    {
        //
    }
}
