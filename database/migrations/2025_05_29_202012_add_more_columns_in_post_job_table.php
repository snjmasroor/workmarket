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
            $table->string('attachments')->nullable()->after('flags');
            $table->string('address')->nullable()->after('attachments');
            $table->string('rate_per_hour')->nullable()->after('address');
            $table->string('radius')->nullable()->after('rate_per_hour');
            $table->string('zip')->nullable()->after('radius');
            $table->date('start_date')->nullable()->after('zip');
            $table->string('estimated_hours')->nullable()->after('start_date');
            $table->string('currency')->nullable()->after('estimated_hours');
            $table->string('payment_terms')->nullable()->after('currency');
            $table->string('payment_type')->nullable()->after('payment_terms');
            $table->text('terms')->nullable()->after('payment_type');
            $table->text('conditions')->nullable()->after('terms');
            $table->text('nda_requirement')->nullable()->after('conditions');
            $table->text('terms_acceptance')->nullable()->after('nda_requirement');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_jobs', function (Blueprint $table) {
           $table->dropColumn([
                'attachments',
                'address',
                'radius',
                'zip',
                'start_date',
                'estimated_hours',
                'currency',
                'payment_terms',
                'payment_type',
                'terms',
                'conditions',
                'nda_requirement',
                'terms_acceptance',
                'rate_per_hour'
            ]);
        });
    }
};
