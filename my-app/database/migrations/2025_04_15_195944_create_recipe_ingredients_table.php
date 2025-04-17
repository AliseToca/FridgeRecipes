<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use function Laravel\Prompts\table;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipe_ingredients', function (Blueprint $table) {
            $table->foreignId('recipes_id')->constrained()->onDelete('cascade');
            $table->foreignId('ingredients_id')->constrained()->onDelete('cascade');

            $table->primary(['recipes_id', 'ingredients_id']);

            $table->integer('amount')->default('1');
            $table->string('unit')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipe_ingredients'); //$recipe->user->username; in controller
    }
};
