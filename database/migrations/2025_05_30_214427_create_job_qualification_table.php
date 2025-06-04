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
        Schema::create('job_qualifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id')->index(); // Foreign key to jobs
            $table->string('education_level')->nullable(); // e.g., Bachelor's, High School
            $table->integer('min_years_experience')->nullable(); // Required experience
            $table->string('license')->nullable(); // Required license (if any)
            $table->string('attachments')->nullable(); // Required license (if any)
            $table->string('language')->nullable(); // Language proficiency (optional)
            $table->text('description')->nullable(); // Language proficiency (optional)
            $table->bigInteger('flags')->default(0); // Security requirement
            $table->timestamps();

            $table->foreign('job_id')->references('id')->on('post_jobs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_qualifications');
    }
};
