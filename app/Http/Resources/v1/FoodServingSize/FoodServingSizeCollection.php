<?php

namespace App\Http\Resources\v1\FoodServingSize;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FoodServingSizeCollection extends ResourceCollection
{
    public $collects = FoodServingSizeResource::class;

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
