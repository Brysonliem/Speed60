<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'phone_number' => '088811112222',
            'address' => 'Earth',
            'province' => 'Earth',
            'city' => 'Earth',
            'district' => 'Earth',
            'block' => 'Earth',
            'rt' => '000',
            'rw' => '111',
            'role_id' => Role::where('level', 2)->first()->id,
            'password' => '123456',
        ]);
    }
}
