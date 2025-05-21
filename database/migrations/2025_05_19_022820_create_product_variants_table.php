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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('product_id')
                ->constrained('products')
                ->onDelete('cascade');
            $table->string('color');
            $table->string('color_code');
            $table->integer('current_stock');
            $table->float('price');
            $table->enum('purchase_unit', ['set', 'pcs'])->default('pcs');
            $table->integer('unit_per_set')->nullable()->comment('units of the product that can be bought per set, null if purchase_unit is set to pcs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
