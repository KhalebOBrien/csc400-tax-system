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
        Schema::table('personal_filings', function (Blueprint $table) {
            $table->decimal('basic_salary', 10, 2)->nullable()->after('trxn_ref');
            $table->decimal('housing_allowance', 10, 2)->nullable()->after('basic_salary');
            $table->decimal('transport_allowance', 10, 2)->nullable()->after('housing_allowance');
            $table->decimal('misc_allowance', 10, 2)->nullable()->after('transport_allowance');
            $table->string('payment_type')->default('monthly')->nullable()->after('misc_allowance');
            $table->decimal('monthly_amount', 10, 2)->nullable()->after('payment_type');
            $table->decimal('yearly_amount', 10, 2)->nullable()->after('monthly_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_filings');
    }
};
