<?php

namespace App\Http\Resources\v1\Food;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\FoodGroup\FoodGroupResource;
use App\Http\Resources\v1\FoodNutrient\FoodNutrientCollection;

class FoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'food_group_id' => $this->food_group_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'nutrients' => new FoodNutrientCollection($this->whenLoaded('nutrients')),
            'group' => new FoodGroupResource($this->whenLoaded('group')),
        ];
    }
}
