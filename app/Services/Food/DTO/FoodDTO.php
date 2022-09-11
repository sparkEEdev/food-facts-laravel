<?php

namespace App\Services\Food\DTO;

class FoodDTO
{

    private string $name;

    private string $description;

    private string $foodGroup;

    public function __construct(string $name, string $description, string $foodGroup)
    {
        $this->name = $name;
        $this->description = $description;
        $this->foodGroup = $foodGroup;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function foodGroup(): string
    {
        return $this->foodGroup;
    }
}
