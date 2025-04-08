<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'SUPERADMIN','level' => 1],
            ['name' => 'ADMIN','level' => 2],
            ['name' => 'USER','level' => 3],
        ];

        foreach($data as $d)
        {
            DB::transaction(function() use ($d){
                Role::create($d);
            });
        }
    }
}
