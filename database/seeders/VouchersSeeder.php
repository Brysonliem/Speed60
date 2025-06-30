<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VouchersSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $vouchers = [
            [
                'voucher_code' => 'DISC10',
                'voucher_name' => 'Diskon 10%',
                'voucher_type' => 'SIGNUP',
                'voucher_minimum_transaction' => 10,
                'voucher_is_disabled' => false,
                'voucher_description' => 'Diskon sebesar 10% untuk transaksi di atas Rp50.000',
                'voucher_discount_percentage' => 10,
                'voucher_start_date' => $now->copy()->subDays(5),
                'voucher_end_date' => $now->copy()->addDays(30),
                'voucher_created_by' => 1, // ganti dengan user ID yang ada
            ],
            [
                'voucher_code' => 'WELCOME15',
                'voucher_name' => 'Voucher Pengguna Baru',
                'voucher_type' => 'REGULER',
                'voucher_minimum_transaction' => 0,
                'voucher_is_disabled' => false,
                'voucher_description' => 'Diskon 15% untuk pengguna baru',
                'voucher_discount_percentage' => 15,
                'voucher_start_date' => $now->copy()->subDays(2),
                'voucher_end_date' => $now->copy()->addDays(60),
                'voucher_created_by' => 1,
            ],
            [
                'voucher_code' => 'HEMAT20',
                'voucher_name' => 'Voucher HEMAT 20%',
                'voucher_type' => 'REGULER',
                'voucher_minimum_transaction' => 24,
                'voucher_is_disabled' => false,
                'voucher_description' => 'Diskon 20% untuk pembelian minimal Rp100.000',
                'voucher_discount_percentage' => 20,
                'voucher_start_date' => $now,
                'voucher_end_date' => $now->copy()->addDays(45),
                'voucher_created_by' => 1,
            ],
            [
                'voucher_code' => 'MIDSALE',
                'voucher_name' => 'Mid Year Sale',
                'voucher_type' => 'REGULER',
                'voucher_minimum_transaction' => 12,
                'voucher_is_disabled' => false,
                'voucher_description' => 'Voucher mid year sale khusus bulan ini',
                'voucher_discount_percentage' => 25,
                'voucher_start_date' => $now->copy()->subDays(1),
                'voucher_end_date' => $now->copy()->addDays(10),
                'voucher_created_by' => 1,
            ],
            [
                'voucher_code' => 'DISABLE50',
                'voucher_name' => 'Voucher Tidak Aktif',
                'voucher_type' => 'REGULER',
                'voucher_minimum_transaction' => 11,
                'voucher_is_disabled' => true,
                'voucher_description' => 'Voucher ini sudah tidak aktif',
                'voucher_discount_percentage' => 50,
                'voucher_start_date' => $now->copy()->subDays(10),
                'voucher_end_date' => $now->copy()->addDays(5),
                'voucher_created_by' => 1,
            ],
        ];

        collect($vouchers)->each(function ($voucher) {
            Voucher::create($voucher);
        });
    }
}
