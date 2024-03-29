<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shoppingLists', function (Blueprint $table) {
            $table->id('pk_shoppingList_id');
            $table->integer('fk_household_id');
            $table->foreign('fk_household_id')->references('pk_household_id')->on('households')->onDelete('cascade');
            $table->string('shoppingList_name');
            $table->boolean('completed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shoppingLists');
    }
};
