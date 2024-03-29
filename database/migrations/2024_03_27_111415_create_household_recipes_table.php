<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('household_recipes', function (Blueprint $table) {
            $table->unsignedInteger('fk_pk_household_id');
            $table->unsignedInteger('fk_pk_recipe_id');
            $table->foreign('fk_pk_household_id')->references('pk_household_id')->on('households');
            $table->foreign('fk_pk_recipe_id')->references('pk_recipe_id')->on('recipes');
            $table->timestamps();
        });

        DB::unprepared('ALTER TABLE "household_recipes" ADD PRIMARY KEY (fk_pk_household_id, fk_pk_recipe_id)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('household_recipe');
    }
};
