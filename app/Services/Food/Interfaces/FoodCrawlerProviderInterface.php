<?php

namespace App\Services\Food\Interfaces;

interface FoodCrawlerProviderInterface
{
    /**
     * @return \App\Services\Food\DTO\FoodGroupDTO[]
     */
    public function crawlFoodGroups(): array;

    /**
     * @return \App\Services\Food\DTO\FoodDTO[]
     */
    public function crawlFoods(): array;

    /**
     * @return \App\Services\Food\DTO\FoodNutrientDTO[]
     */
    public function crawlFoodNutrients(): array;
}
