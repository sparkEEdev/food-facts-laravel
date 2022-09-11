<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodNutrientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_nutrients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('food_id');
            $table->foreign('food_id')->references('id')->on('foods');
            $table->unsignedBigInteger('food_serving_size_id');
            $table->foreign('food_serving_size_id')->references('id')->on('food_serving_sizes');
            $table->unique(['food_id', 'food_serving_size_id']);
            $table->integer('calories');
            $table->integer('fat');
            $table->integer('carbohydrates');
            $table->integer('protein');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_nutrients');
    }
}
