<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Food;
use App\Http\Middleware\Authenticated;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FoodTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->withHeaders([
            'Accept' => 'application/json',
        ]);

        $this->withoutMiddleware(Authenticated::class);

        Food::factory([
            'id' => 1,
            'name' => 'Apple',
            'description' => 'Apple description',
            'food_group_id' => null,
        ])->create();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_update_food_action_unique_name_constraint_response()
    {
        Food::factory([
            'id' => 2,
            'name' => 'Banana',
            'description' => 'Banana description',
            'food_group_id' => null,
        ])->create();

        $response = $this->put('/api/v1/foods/2', [
            'name' => 'Apple',
        ]);

        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'Name of the food is already taken.',
        ]);
    }

    public function test_update_food_action_not_found_response()
    {
        $response = $this->put('/api/v1/foods/99', [
            'name' => 'Apple',
        ]);

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'Food not found.',
        ]);
    }

    public function test_update_food_action_success_response()
    {
        $response = $this->put('/api/v1/foods/1', [
            'name' => 'Green Apple',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Food updated successfully.',
        ]);

        $this->assertDatabaseHas('foods', [
            'id' => 1,
            'name' => 'Green Apple',
            'slug' => 'green-apple',
        ]);
    }
}
