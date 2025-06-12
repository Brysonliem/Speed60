<?php

namespace Database\Seeders;

use App\Models\MotorCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotorCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_list = [
            ['name' => 'NMAX',        'code' => 'nmax'],
            ['name' => 'AEROX',       'code' => 'aerox'],
            ['name' => 'MIO M3',      'code' => 'mio-m3'],
            ['name' => 'LEXI',        'code' => 'lexi'],
            ['name' => 'XMAX',        'code' => 'xmax'],
            ['name' => 'VARIO 125',   'code' => 'vario-125'],
            ['name' => 'VARIO 160',   'code' => 'vario-160'],
            ['name' => 'BEAT',        'code' => 'beat'],
            ['name' => 'SCOOPY',      'code' => 'scoopy'],
            ['name' => 'PCX 160',     'code' => 'pcx-160'],
            ['name' => 'ADV 160',     'code' => 'adv-160'],
            ['name' => 'CB150R',      'code' => 'cb150r'],
            ['name' => 'CBR150R',     'code' => 'cbr150r'],
            ['name' => 'CBR250RR',    'code' => 'cbr250rr'],
            ['name' => 'MT-15',       'code' => 'mt-15'],
            ['name' => 'R15',         'code' => 'r15'],
            ['name' => 'GSX-R150',    'code' => 'gsx-r150'],
            ['name' => 'SATRIA FU',   'code' => 'satria-fu'],
            ['name' => 'KLX 150',     'code' => 'klx-150'],
            ['name' => 'W175',        'code' => 'w175'],
        ];

        collect($data_list)->each(function($data) {
            MotorCategory::create($data);
        });
    }
}
