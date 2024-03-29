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
        Schema::create('product_stores', function (Blueprint $table) {
            $table->unsignedInteger('fk_pk_product_id');
            $table->unsignedInteger('fk_pk_store_id');
            $table->decimal('product_price', 4, 2);
            $table->foreign('fk_pk_product_id')->references('pk_product_id')->on('products');
            $table->foreign('fk_pk_store_id')->references('pk_store_id')->on('stores');
            $table->timestamps();
        });

        DB::unprepared('ALTER TABLE "product_stores" ADD PRIMARY KEY (fk_pk_product_id, fk_pk_store_id)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_stores');
    }
};
