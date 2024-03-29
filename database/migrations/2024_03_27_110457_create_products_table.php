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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('pk_product_id');
            $table->unsignedInteger('fk_ingredient_id')->nullable();
            $table->foreign('fk_ingredient_id')->references('pk_ingredient_id')->on('ingredients');
            $table->string('product_name')->unique();
            $table->string('product_company');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_store');
        Schema::dropIfExists('shoppingList_product');
        Schema::dropIfExists('products');
    }
};
