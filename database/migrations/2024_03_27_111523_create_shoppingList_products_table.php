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
        Schema::create('shoppingList_products', function (Blueprint $table) {
            $table->unsignedInteger('fk_pk_shoppingList_id');
            $table->unsignedInteger('fk_pk_product_id');
            $table->string('amount');
            $table->foreign('fk_pk_shoppingList_id')->references('pk_shoppingList_id')->on('shoppingLists');
            $table->foreign('fk_pk_product_id')->references('pk_product_id')->on('products');
            $table->timestamps();
        });

        DB::unprepared('ALTER TABLE "shoppingList_products" ADD PRIMARY KEY ("fk_pk_shoppingList_id", fk_pk_product_id)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shoppingList_product');
    }
};
