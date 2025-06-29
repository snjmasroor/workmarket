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
        Schema::create('job_certifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('post_jobs')->onDelete('cascade');
            $table->foreignId('certification_id')->constrained('certifications')->onDelete('cascade');
            $table->string('short_description')->nullable(); // e.g., "Amazon Web Services"
            $table->bigInteger('flags')->default(0); // Security requirement
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_certifications');
    }
};
