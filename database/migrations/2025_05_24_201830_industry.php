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
        Schema::create('industries', function (Blueprint $table) {
            $table->id();
            $table->string('industry_id')->nullable()->unique();
            $table->string('name');
             $table->bigInteger('flags')->default(0);
            $table->timestamps();
        });

        // Add industry_id to users table
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('industry_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['industry_id']);
            $table->dropColumn('industry_id');
        });

        Schema::dropIfExists('industries');
    }
};
