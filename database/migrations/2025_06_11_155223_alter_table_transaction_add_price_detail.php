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
        Schema::table('transactions', function (Blueprint $table) {
            $table->decimal('sub_total', 15,2)->nullable()->after('transaction_status');
            $table->decimal('shipping_price', 15, 2)->nullable()->after('sub_total');
            $table->decimal('tax_price', 15, 2)->nullable()->after('shipping_price');
            $table->decimal('discount_price', 15, 2)->nullable()->after('tax_price');
            $table->decimal('grand_total', 15, 2)->nullable()->after('discount_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn([
                'sub_total',
                'shipping_price',
                'tax_price',
                'discount_price',
                'grand_total'
            ]);
        });
    }
};
