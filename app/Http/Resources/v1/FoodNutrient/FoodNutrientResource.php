<?php

namespace App\Http\Resources\v1\FoodNutrient;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\FoodServingSize\FoodServingSizeResource;

class FoodNutrientResource extends JsonResource
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
            'food_id' => $this->food_id,
            'food_serving_size_id' => $this->food_serving_size_id,
            'calories' => $this->calories,
            'carbohydrates' => $this->readable_carbohydrates,
            'fat' => $this->readable_fat,
            'protein' => $this->readable_protein,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'serving_size' => $this->whenLoaded('serving_size', fn() => new FoodServingSizeResource($this->serving_size)),
        ];
    }
}
