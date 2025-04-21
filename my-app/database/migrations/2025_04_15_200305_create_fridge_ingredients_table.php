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
            $table->foreignId('fridges_id')->constrained()->onDelete('cascade');
            $table->foreignId('ingredients_id')->constrained()->onDelete('cascade');

            $table->primary(['fridges_id', 'ingredients_id']);

            $table->integer('amount')->nullable();
            $table->string('unit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.a
     */
    public function down(): void
    {
        Schema::dropIfExists('fridge_ingredients');
    }
};
