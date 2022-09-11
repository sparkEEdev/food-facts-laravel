<?php

namespace App\Http\Resources\v1\FoodGroup;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FoodGroupCollection extends ResourceCollection
{
    public $collects = FoodGroupResource::class;

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
