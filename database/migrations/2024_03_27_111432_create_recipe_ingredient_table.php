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
        Schema::create('recipe_ingredient', function (Blueprint $table) {
            $table->unsignedInteger('fk_pk_recipe_id');
            $table->unsignedInteger('fk_pk_ingredient_id');
            $table->string('amount');
            $table->foreign('fk_pk_recipe_id')->references('pk_recipe_id')->on('recipes');
            $table->foreign('fk_pk_ingredient_id')->references('pk_ingredient_id')->on('ingredients');
            $table->timestamps();
        });

        DB::unprepared('ALTER TABLE recipe_ingredient ADD PRIMARY KEY (fk_pk_recipe_id, fk_pk_ingredient_id)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe_ingredient');
    }
};
