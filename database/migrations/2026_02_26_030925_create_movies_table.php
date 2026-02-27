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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tmdb_id')->unique()->nullable();
            $table->string('title');
            $table->text('overview')->nullable();
            $table->string('poster_url')->nullable();
            $table->date('release_date')->nullable();
            $table->string('genre')->nullable();
            $table->float('rating')->nullable();
            $table->timestamp('synced_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
