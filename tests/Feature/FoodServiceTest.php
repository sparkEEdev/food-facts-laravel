<?php

namespace Tests\Feature;

use stdClass;
use Tests\TestCase;
use App\Services\Food\DTO\FoodDTO;
use App\Services\Food\DTO\FoodGroupDTO;
use App\Services\Food\FoodService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Food\Providers\FatSecretGoutteProvider;

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

        $provider = $this->createMock(FatSecretGoutteProvider::class);

        $provider->method('crawlFoodGroups')
            ->willReturn([
                new FoodGroupDTO('Fruits', 'Fruits are the sweet and fleshy product of a tree or other plant that contains seed and can be eaten as food.'),
                new stdClass(), // Invalid value
                new FoodGroupDTO('Sweets', 'Sweets are foods that are sweet to taste, especially desserts.'),
            ]);

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

        $provider = $this->createMock(FatSecretGoutteProvider::class);

        $provider->method('crawlFoods')
            ->willReturn([
                new FoodDTO('Apple', 'Apple description', 'Fruits'),
                new stdClass(), // Invalid value
                new FoodDTO('Wheat', 'Wheat description', 'Grains'),
            ]);

        $service = new FoodService($provider);

        $service->processFoods();
    }

    public function test_process_food_groups_saves_to_database()
    {
        $provider = $this->createMock(FatSecretGoutteProvider::class);

        $provider->method('crawlFoodGroups')
            ->willReturn([
                new FoodGroupDTO('Fruits', 'Fruits are the sweet and fleshy product of a tree or other plant that contains seed and can be eaten as food.'),
                new FoodGroupDTO('Meat', 'Meat is animal flesh that is eaten as food.'),
                new FoodGroupDTO('Fats', 'Fats are a group of naturally occurring organic compounds that are fatty acids and glycerol, the esters of fatty acids.'),
                new FoodGroupDTO('Sweets', 'Sweets are foods that are sweet to taste, especially desserts.'),
            ]);

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
        $provider = $this->createMock(FatSecretGoutteProvider::class);

        $provider->method('crawlFoods')
            ->willReturn([
                new FoodDTO('Apple', 'Apple description', 'Fruits'),
                new FoodDTO('Wheat', 'Wheat description', 'Grains'),
                new FoodDTO('Beef', 'Beef description', 'Meat'),
                new FoodDTO('Butter', 'Butter description', 'Fats'),
                new FoodDTO('Chocolate', 'Chocolate description', 'Sweets'),
            ]);

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
        $provider = $this->createMock(FatSecretGoutteProvider::class);

        $provider->method('crawlFoodGroups')
            ->willReturn([
                new FoodGroupDTO('Fruits', 'Fruits are the sweet and fleshy product of a tree or other plant that contains seed and can be eaten as food.'),
                new FoodGroupDTO('Meat', 'Meat is animal flesh that is eaten as food.'),
            ]);

        $provider->method('crawlFoods')
            ->willReturn([
                new FoodDTO('Apple', 'Apple description', 'Fruits'),
                new FoodDTO('Wheat', 'Wheat description', 'Grains'),
                new FoodDTO('Beef', 'Beef description', 'Meat'),
            ]);

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
