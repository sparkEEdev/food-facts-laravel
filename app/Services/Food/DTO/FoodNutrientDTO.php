<?php

namespace App\Services\Food\DTO;

class FoodNutrientDTO
{
    private string $calories;
    private string $fat;
    private string $carbohydrates;
    private string $protein;


    public function __construct(string $calories, string $fat, string $carbohydrates, string $protein)
    {
        $this->calories = $calories;
        $this->fat = $fat;
        $this->carbohydrates = $carbohydrates;
        $this->protein = $protein;
    }

    public function calories(): string
    {
        return $this->calories;
    }

    public function fat(): string
    {
        return $this->fat;
    }

    public function carbohydrates(): string
    {
        return $this->carbohydrates;
    }

    public function protein(): string
    {
        return $this->protein;
    }
}
