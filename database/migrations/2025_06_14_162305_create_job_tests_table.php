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
        Schema::create('job_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('post_jobs')->onDelete('cascade');
            $table->foreignId('test_id')->constrained('tests')->onDelete('cascade');
            $table->string('title')->nullable(); // e.g., "Technical Skill Test"
            $table->text('description')->nullable(); // instructions
            $table->string('link')->nullable(); // test URL or platform
            $table->string('scoring_criteria')->nullable();
            $table->bigInteger('flags')->default(0); // Security requirement
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_tests');
    }
};
