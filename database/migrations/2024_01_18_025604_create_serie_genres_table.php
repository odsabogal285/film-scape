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
        Schema::create('serie_genres', function (Blueprint $table) {
            $table->unsignedBigInteger('serie_id');
            $table->unsignedBigInteger('genre_id');

            $table->foreign('serie_id')->on('movies')->references('id');
            $table->foreign('genre_id')->on('genres')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serie_genres');
    }
};
