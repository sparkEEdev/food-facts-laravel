<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodNutrient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'food_id',
        'food_serving_size_id',
        'calories',
        'fat',
        'carbohydrates',
        'protein'
    ];

    public function setCarbohydratesAttribute($value)
    {
        $this->attributes['carbohydrates'] = $value * 100;
    }

    public function getReadableCarbohydratesAttribute()
    {
        return $this->carbohydrates / 100;
    }

    public function setFatAttribute($value)
    {
        $this->attributes['fat'] = $value * 100;
    }

    public function getReadableFatAttribute()
    {
        return $this->fat / 100;
    }

    public function setProteinAttribute($value)
    {
        $this->attributes['protein'] = $value * 100;
    }

    public function getReadableProteinAttribute()
    {
        return $this->protein / 100;
    }


    /**
     * Get the food that owns the food nutrient.
     */
    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id', 'id');
    }

    /**
     * Get the serving size that owns the food nutrient.
     */
    public function serving_size()
    {
        return $this->belongsTo(FoodServingSize::class, 'food_serving_size_id', 'id');
    }
}
