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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('google_id')->unique();
            $table->string('brand');
            $table->string('model');
            $table->year('year')->nullable();
            $table->decimal('price_per_month', 10, 2)->nullable();
            $table->string('fuel')->nullable();
            $table->string('transmission')->nullable();
            $table->string('segment')->nullable();
            $table->json('specs')->nullable();
            $table->json('images')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
