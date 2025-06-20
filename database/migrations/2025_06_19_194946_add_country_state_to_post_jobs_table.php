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
        Schema::table('post_jobs', function (Blueprint $table) {
            $table->string("country")->nullable()->after('deadline');
            $table->double("fixed_rate")->nullable()->after('city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_jobs', function (Blueprint $table) {
            $table->dropColumn([
                'country',
                'fixed_rate'
            ]);
        });
    }
};
