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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('detail_master')
                ->constrained('transactions')
                ->onDelete('cascade');
            $table
                ->foreignId('detail_variant')
                ->constrained('product_variants')
                ->onDelete('cascade');
            $table->integer('detail_qty');
            $table->float('detail_subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
