<?php

namespace Tests\Feature;

use stdClass;
use Tests\TestCase;
use App\Services\Food\DTO\FoodDTO;
use App\Services\Food\FoodService;
use App\Services\Food\DTO\FoodGroupDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Food\Interfaces\FoodCrawlerProviderInterface;

class FoodServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_process_food_groups_throws_invalid_value_exception()
    {
        $this->expectException(\App\Services\Food\Exceptions\InvalidValueException::class);

        $provider = $this->createMock(FoodCrawlerProviderInterface::class);

        $provider->method('crawlFoodGroups')
            ->willReturnCallback(function ($callback) {
                $callback(new FoodGroupDTO('Meat', 'Meat is animal flesh that is eaten as food.'));
                $callback(new stdClass());
                $callback(new FoodGroupDTO('Fruits', 'Fruits are the sweet and fleshy product of a tree or other plant that contains seed and can be eaten as food.'));
            });

        $service = new FoodService($provider);

        $service->processFoodGroups();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_process_foods_throws_invalid_value_exception()
    {
        $this->expectException(\App\Services\Food\Exceptions\InvalidValueException::class);

        $provider = $this->createMock(FoodCrawlerProviderInterface::class);

        $provider->method('crawlFoods')
            ->willReturnCallback(function ($callback) {
                $callback(new FoodDTO('Apple', 'Apple description', 'Fruits'));
                $callback(new stdClass());
                $callback(new FoodDTO('Wheat', 'Wheat description', 'Grains'));
            });

        $service = new FoodService($provider);

        $service->processFoods();
    }

    public function test_process_food_groups_saves_to_database()
    {
        $provider = $this->createMock(FoodCrawlerProviderInterface::class);

        $provider->method('crawlFoodGroups')
            ->willReturnCallback(function ($callback) {
                $callback(new FoodGroupDTO('Meat', 'Meat is animal flesh that is eaten as food.'));
                $callback(new FoodGroupDTO('Fruits', 'Fruits are the sweet and fleshy product of a tree or other plant that contains seed and can be eaten as food.'));
            });

        $service = new FoodService($provider);

        $service->processFoodGroups();

        $this->assertDatabaseHas('food_groups', [
            'name' => 'Fruits',
            'slug' => 'fruits',
            'description' => 'Fruits are the sweet and fleshy product of a tree or other plant that contains seed and can be eaten as food.',
        ]);
    }

    public function test_process_foods_saves_to_database()
    {
        $provider = $this->createMock(FoodCrawlerProviderInterface::class);

        $provider->method('crawlFoods')
            ->willReturnCallback(function ($callback) {
                $callback(new FoodDTO('Apple', 'Apple description', 'Fruits'));
                $callback(new FoodDTO('Wheat', 'Wheat description', 'Grains'));
                $callback(new FoodDTO('Beef', 'Beef description', 'Meat'));
                $callback(new FoodDTO('Pork', 'Pork description', 'Meat'));
            });

        $service = new FoodService($provider);

        $service->processFoods();

        $this->assertDatabaseHas('foods', [
            'name' => 'Apple',
            'slug' => 'apple',
            'description' => 'Apple description',
        ]);
    }

    public function test_validate_relation_between_food_group_and_foods()
    {
        $provider = $this->createMock(FoodCrawlerProviderInterface::class);

        $provider->method('crawlFoodGroups')
            ->willReturnCallback(function ($callback) {
                $callback(new FoodGroupDTO('Fruits', 'Fruits are the sweet and fleshy product of a tree or other plant that contains seed and can be eaten as food.'));
                $callback(new FoodGroupDTO('Meat', 'Meat is animal flesh that is eaten as food.'));
            });

        $provider->method('crawlFoods')
            ->willReturnCallback(function ($callback) {
                $callback(new FoodDTO('Apple', 'Apple description', 'Fruits'));
                $callback(new FoodDTO('Wheat', 'Wheat description', 'Grains'));
                $callback(new FoodDTO('Beef', 'Beef description', 'Meat'));
            });

        $service = new FoodService($provider);

        $service->processFoodGroups();
        $service->processFoods();

        $this->assertDatabaseHas('food_groups', [
            'id' => 1,
            'name' => 'Fruits',
            'slug' => 'fruits',
        ]);

        $this->assertDatabaseMissing('food_groups', [
            'name' => 'Wheat',
            'slug' => 'wheat',
        ]);

        $this->assertDatabaseHas('foods', [
            'name' => 'Apple',
            'slug' => 'apple',
            'food_group_id' => 1,
        ]);

        $this->assertDatabaseHas('foods', [
            'name' => 'Wheat',
            'slug' => 'wheat',
            'food_group_id' => null,
        ]);
    }
}
