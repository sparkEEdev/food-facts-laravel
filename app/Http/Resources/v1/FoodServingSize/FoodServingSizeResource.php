<?php

namespace App\Http\Resources\v1\FoodServingSize;

use Illuminate\Http\Resources\Json\JsonResource;

class FoodServingSizeResource extends JsonResource
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
            'name' => $this->name,
            'measurement' => $this->measurement,
            'portion_size' => $this->portion_size,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
