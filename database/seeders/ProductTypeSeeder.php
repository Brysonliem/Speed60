<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Baut'],
            ['name' => 'Mur'],
            ['name' => 'Kunci Inggris'],
            ['name' => 'Obeng Minus'],
            ['name' => 'Obeng Plus'],
            ['name' => 'Kunci Ring'],
            ['name' => 'Kunci Pas'],
            ['name' => 'Tang Kombinasi'],
            ['name' => 'Tang Potong'],
            ['name' => 'Dongkrak Mobil'],
            ['name' => 'Kunci L'],
            ['name' => 'Seal Tape'],
            ['name' => 'Amplas'],
            ['name' => 'Lem Besi'],
            ['name' => 'Tutup Pentil'],
            ['name' => 'Selang Rem'],
            ['name' => 'Kabel Aki'],
            ['name' => 'Lakban Hitam'],
            ['name' => 'Minyak Rem'],
            ['name' => 'Oli Mesin'],
        ];

        foreach ($data as $item) {
            \App\Models\ProductType::create($item);
        }
    }

}
