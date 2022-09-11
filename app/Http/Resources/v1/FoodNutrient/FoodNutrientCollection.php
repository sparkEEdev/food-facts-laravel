<?php

namespace App\Http\Resources\v1\FoodNutrient;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FoodNutrientCollection extends ResourceCollection
{
    public $collects = FoodNutrientResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
