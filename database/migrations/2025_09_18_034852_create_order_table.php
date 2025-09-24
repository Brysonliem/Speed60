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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->biginteger('amount');
            $table->string('currency', 10)->default("IDR");
            $table->string('status')->default('PENDING'); // PENDING | PAID | EXPIRED | FAILED
            $table->string('xendit_invoice_id')->nullable()->index();
            $table->string('xendit_invoice_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
