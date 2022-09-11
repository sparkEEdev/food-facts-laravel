<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'food_group_id',
        'name',
        'slug',
        'description'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    /**
     * Get the food group that owns the food.
     */
    public function group()
    {
        return $this->belongsTo(FoodGroup::class, 'food_group_id', 'id');
    }

    /**
     * Get the food nutrients for the food.
     */
    public function nutrients()
    {
        return $this->hasMany(FoodNutrient::class, 'food_id', 'id');
    }
}
