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
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., Power Drill, Laptop, PPE Kit
            $table->text('description')->nullable(); // Details about the toolp
            $table->string('type')->nullable(); // e.g., Safety, Software, Hardware
            $table->string('model')->nullable(); // Optional: model/version of tool
            $table->string('verification_method')->nullable(); // e.g., photo upload, serial number
            $table->decimal('price', 10, 2)->nullable();
            $table->bigInteger('flags')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tools');
    }
};
