<?php

namespace App\Actions\Food;

use Exception;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use App\Http\Resources\v1\Food\FoodResource;
use App\Http\Resources\v1\Food\FoodCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateFoodAction
{
    /**
     * Get all food groups.
     *
     * @return \App\Http\Resources\v1\Food\FoodResource|\Illuminate\Http\JsonResponse
     */
    public function execute(Request $request, int $id)
    {
        try {

            $food = Food::findOrFail($id);
            $food->update($request->validated());

            return response()->json([
                'message' => 'Food updated successfully.',
                'data' => new FoodResource($food)
            ], 200);

        } catch (ModelNotFoundException $e) {

            return response()->json(['message' => 'Food not found.'], 404);

        } catch (QueryException $e) {

            /* if ($e->errorInfo[1] == 1062) {
                // constraint violation (duplicate entry)
                return response()->json(['message' => 'Does not exist.'], 400);
            } */

            if ($e->errorInfo[1] == 19) {
                // constraint violation (unique)
                return response()->json(['message' => 'Name of the food is already taken.'], 400);
            }

            return response()->json(['message' => 'Failed to update.'], 400);

        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong'], 400);
        }
    }
}
