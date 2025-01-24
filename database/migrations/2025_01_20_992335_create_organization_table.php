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
        Schema::create('organizations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable()->index();

            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('tin')->nullable();
            $table->string('rc_number')->nullable();
            $table->integer('number_of_employees')->default(0);
            $table->decimal('estimated_annual_revenue', 10, 2)->default(0.0);

            $table->enum('status', ['pending', 'awaiting_verification', 'approved', 'rejected'])->default('pending');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
