<?php

namespace App\Services\Food\Interfaces;

interface FoodCrawlerProviderInterface
{
    /**
     * @param callable $callback
     * @return void
     */
    public function crawlFoodGroups(callable $callback): void;

    /**
     * @param callable $callback
     * @return void
     */
    public function crawlFoods(callable $callback): void;

    /**
     * @param callable $callback
     * @return void
     */
    public function crawlFoodNutrients(callable $callback): void;
}
