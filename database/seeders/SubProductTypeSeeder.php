<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = collect(range(1, 10))->map(function ($i) {
            return [
                'name' => "M{$i} Hardware Size",
                'code' => "B_M{$i}",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });

        DB::table('sub_product_type')->insert($datas->toArray());
    }
}
