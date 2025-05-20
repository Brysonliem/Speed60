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
        Schema::table('carts', function (Blueprint $table) {
            if (Schema::hasColumn('carts', 'product_id')) {
                // $table->dropColumn('product_id');
                $table->dropConstrainedForeignId('product_id');
            }
            $table
                ->foreignId('product_variant_id')
                ->after('quantity')
                ->constrained('product_variants')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
