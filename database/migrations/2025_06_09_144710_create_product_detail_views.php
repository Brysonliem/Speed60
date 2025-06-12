<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW list_product_details AS (
                SELECT 
                    pv.id,
                    p.id AS product_id,
                    pv.color,
                    pv.current_stock AS stock,
                    pv.price AS base_price,
                    pv.purchase_unit AS base_unit,
                    pv.unit_per_set,
                    p.`name`,
                    p.`description`,
                    p.`condition`,
                    pt.`name` AS product_type,
                    COUNT(r.id) AS reviews_count
                FROM product_variants pv
                INNER JOIN products p ON pv.product_id = p.id
                INNER JOIN product_types pt ON p.product_type_id = pt.id
                LEFT JOIN reviews r ON r.product_id = p.id
                GROUP BY 
                    pv.id,
                    p.id,
                    pv.color,
                    pv.current_stock,
                    pv.price,
                    pv.purchase_unit,
                    pv.unit_per_set,
                    p.`name`,
                    p.`description`,
                    p.`condition`,
                    pt.`name`
            )
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS list_product_details');
    }
};
