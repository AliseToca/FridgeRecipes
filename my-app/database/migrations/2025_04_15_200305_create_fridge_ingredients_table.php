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
        Schema::create('fridge_ingredients', function (Blueprint $table) {
            $table->foreignId('users_id')->constrained()->onDelete('cascade');
            $table->foreignId('ingredients_id')->constrained()->onDelete('cascade');

            $table->primary(['users_id', 'ingredients_id']);

            $table->integer('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fridge_ingredients');
    }
};
