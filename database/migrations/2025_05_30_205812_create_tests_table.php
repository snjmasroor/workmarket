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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // e.g., Safety Protocol Test
            $table->text('description')->nullable(); // Details about the test
            $table->integer('passing_score')->default(70); // Minimum passing percentage
            $table->integer('max_attempts')->nullable(); // Optional limit on retakes
            $table->integer('duration_minutes')->nullable(); // Time limit in minutes
            $table->string('test_type')->nullable(); // e.g., MCQ, Practical, Simulation
            $table->bigInteger('flags')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
