<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\FoodGroup;
use App\Http\Middleware\Authenticated;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FoodGroupTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->withHeaders([
            'Accept' => 'application/json',
        ]);

        $this->withoutMiddleware(Authenticated::class);

        FoodGroup::factory([
            'id' => 1,
            'name' => 'Fruit',
            'description' => 'Fruit description',
        ])->create();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_update_food_group_action_unique_name_constraint_response()
    {
        FoodGroup::factory([
            'id' => 2,
            'name' => 'Meat',
            'description' => 'Meat description',
        ])->create();

        $response = $this->put('/api/v1/food-groups/2', [
            'name' => 'Fruit',
        ]);

        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'Name of the food group is already taken.',
        ]);
    }

    public function test_update_food_action_not_found_response()
    {
        $response = $this->put('/api/v1/food-groups/99', [
            'name' => 'Meat',
        ]);

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'Food group not found.',
        ]);
    }

    public function test_update_food_group_action_success_response()
    {
        $response = $this->put('/api/v1/food-groups/1', [
            'name' => 'Chicken Meat',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Food group updated successfully.',
        ]);

        $this->assertDatabaseHas('food_groups', [
            'id' => 1,
            'name' => 'Chicken Meat',
            'slug' => 'chicken-meat',
        ]);
    }
}
