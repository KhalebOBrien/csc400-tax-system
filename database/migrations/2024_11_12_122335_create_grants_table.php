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
        Schema::create('grants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable()->index();

            $table->string('full_name');
            $table->string('age')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('email')->nullable();

            $table->string('grant_purpose')->nullable();
            $table->text('idea_short_description')->nullable();

            $table->string('expected_funding')->nullable();
            $table->string('payment_means')->nullable();
            $table->text('fund_use_cases')->nullable();

            $table->string('issued_id_front_path', 2048)->nullable();
            $table->string('issued_id_back_path', 2048)->nullable();
            $table->string('ssn_or_tin')->nullable();

            $table->string('campaign')->nullable();
            $table->boolean('received_grants_before')->default(false)->nullable(false);
            $table->text('past_grants_details')->nullable();

            $table->string('certification_name')->nullable();
            $table->string('certification_date')->nullable();

            $table->enum('status', ['pending', 'awaiting_verification', 'approved', 'rejected'])->default('pending');
            $table->text('verification_url')->nullable();
            $table->string('verification_proof_path', 2048)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grants');
    }
};
