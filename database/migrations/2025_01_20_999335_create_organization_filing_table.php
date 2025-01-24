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
        Schema::create('organization_filings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('organization_id')->nullable()->index();

            $table->string('trxn_ref')->nullable();
            $table->decimal('income_amount', 10, 2)->nullable();
            $table->date('income_duration_start_date')->nullable();
            $table->date('income_duration_end_date')->nullable();
            $table->decimal('computed_tax_amount', 10, 2)->nullable();

            $table->text('short_note')->nullable();

            $table->enum('payment_status', ['pending', 'approved', 'declined'])->default('pending');
            $table->enum('status', ['pending', 'awaiting_verification', 'approved', 'rejected'])->default('pending');
            $table->text('payment_url')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_filings');
    }
};
