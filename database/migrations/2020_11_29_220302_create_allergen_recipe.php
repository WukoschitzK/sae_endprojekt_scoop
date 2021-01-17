<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllergenRecipe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allergen_recipe', function (Blueprint $table) {
//            $table->id();
//            $table->timestamps();

            $table->unsignedBigInteger('allergen_id')->nullable();
            $table->foreign('allergen_id')->references('id')->on('allergens')->cascadeOnDelete();

            $table->unsignedBigInteger('recipe_id')->nullable();
            $table->foreign('recipe_id')->references('id')->on('recipes')->cascadeOnDelete();

            $table->primary(['allergen_id','recipe_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allergen_recipe');
    }
}
