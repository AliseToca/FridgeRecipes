<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Drop the recipes table
        Schema::dropIfExists('recipes');
    }

    public function down()
    {
        // Recreate the recipes table in case of rollback
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('img');
            $table->integer('minutes');
            $table->integer('rating');
            $table->integer('ingredients');
            $table->timestamps();
        });
    }
};
