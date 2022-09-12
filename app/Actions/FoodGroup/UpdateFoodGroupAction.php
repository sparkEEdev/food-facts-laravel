<?php

namespace App\Actions\FoodGroup;

use Exception;
use App\Models\FoodGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use App\Http\Resources\v1\FoodGroup\FoodGroupResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateFoodGroupAction
{
    /**
     * Get all food groups.
     *
     * @return \App\Http\Resources\v1\FoodGroup\FoodGroupResource|\Illuminate\Http\JsonResponse
     */
    public function execute(Request $request, int $id)
    {
        try {

            $group = FoodGroup::findOrFail($id);
            $group->update($request->validated());

            return response()->json([
                'message' => 'Food group updated successfully.',
                'data' => new FoodGroupResource($group)
            ], 200);

        } catch (ModelNotFoundException $e) {

            return response()->json(['message' => 'Food group not found.'], 404);

        } catch (QueryException $e) {

            /* if ($e->errorInfo[1] == 1062) {
                // unique constraint violation (duplicate entry)
                return response()->json(['message' => 'Name of the food group is already taken.'], 400);
            } */

            if ($e->errorInfo[1] == 19) {
                // constraint violation (unique)
                return response()->json(['message' => 'Name of the food group is already taken.'], 400);
            }

            return response()->json(['message' => 'Failed to update.'], 400);

        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong'], 400);
        }
    }
}
