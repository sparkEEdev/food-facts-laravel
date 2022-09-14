<?php

namespace App\Services\Food;

use Carbon\Carbon;
use App\Models\Food;
use App\Models\FoodGroup;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Services\Food\DTO\FoodDTO;
use App\Services\Food\DTO\FoodGroupDTO;
use App\Services\Food\Exceptions\InvalidValueException;
use App\Services\Food\Interfaces\FoodCrawlerProviderInterface;
use Exception;

class FoodService
{
    private FoodCrawlerProviderInterface $provider;

    public function __construct(FoodCrawlerProviderInterface $provider)
    {
        $this->provider = $provider;
    }


    public function processFoodGroups()
    {
        $this->provider->crawlFoodGroups(function ($foodGroup) {
            if ( !($foodGroup instanceof FoodGroupDTO) ) {
                throw new InvalidValueException('FoodGroupDTO expected');
            }

            FoodGroup::updateOrCreate(
                [
                    'name' => $foodGroup->name(),
                ],
                [
                    'description' => $foodGroup->description(),
                ]
            );
        });
    }

    public function processFoods()
    {
        $this->provider->crawlFoods(function ($food) {
            if ( !($food instanceof FoodDTO) ) {
                throw new InvalidValueException('FoodDTO expected');
            }

            $group = FoodGroup::where('slug', Str::slug($food->foodGroup(), '-'))
                ->first();

            $food = Food::updateOrCreate(
                [
                    'name' => $food->name(),
                ],
                [
                    'description' => $food->description(),
                    'food_group_id' => $group ? $group->id : null,
                ],
            );
        });
    }

    public function processFoodNutrients()
    {
        throw new Exception('Not implemented');
    }
}
