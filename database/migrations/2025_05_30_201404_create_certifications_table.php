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
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., OSHA 10, Forklift License
            $table->text('description')->nullable(); // Details about the certification
            $table->string('issuing_organization')->nullable(); // e.g., OSHA, Red Cross
            $table->string('certification_level')->nullable(); // e.g., Basic, Advanced
            $table->string('validity_period')->nullable(); // e.g., 2 years, 5 years
            $table->date('expiration_date')->nullable(); // For tracking if expired
            $table->string('verification_method')->nullable(); // e.g., upload, link
            $table->bigInteger('flags')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certifications');
    }
};
