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
        Schema::create('user_households', function (Blueprint $table) {
            $table->unsignedInteger('fk_pk_user_id');
            $table->unsignedInteger('fk_pk_household_id');
            $table->boolean('isAdmin');
            $table->foreign('fk_pk_user_id')->references('pk_user_id')->on('users')->onDelete('cascade');
            $table->foreign('fk_pk_household_id')->references('pk_household_id')->on('households')->onDelete('cascade');
            $table->timestamps();
        });

        DB::unprepared('ALTER TABLE user_households ADD PRIMARY KEY (fk_pk_user_id, fk_pk_household_id)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_households');
    }
};
