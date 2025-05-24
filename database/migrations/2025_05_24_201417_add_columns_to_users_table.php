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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('user_id')->nullable()->unique();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->text('device_token')->nullable();
            $table->bigInteger('flags')->default(0);
            $table->softDeletes();
        });// Optional: use tinyInteger if needed 
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn([
                'user_id',
                'firstname',
                'lastname',
                'username',
                'phone',
                'image',
                'device_token',
                'flags'
            ]);
        });
    }
};
