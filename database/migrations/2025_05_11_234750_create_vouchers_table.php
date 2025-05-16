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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_code')->unique();
            $table->string('voucher_name');
            $table->double('voucher_minimum_transaction')->default(0);
            $table->boolean('voucher_is_disabled')->default(false);
            $table->string('voucher_description')->nullable();
            $table->double('voucher_discount_percentage');
            $table->date('voucher_start_date')->default(now());
            $table->date('voucher_end_date')->nullable();
            $table
                ->foreignId('voucher_created_by')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
