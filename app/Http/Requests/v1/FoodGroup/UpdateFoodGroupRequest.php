<?php

namespace App\Http\Requests\v1\FoodGroup;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFoodGroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }
}
