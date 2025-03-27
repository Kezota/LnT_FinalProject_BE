<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'nama_lengkap' => 'Master Admin',
            'id_admin' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'nomor_handphone' => '081234567890',
        ]);
    }
}
