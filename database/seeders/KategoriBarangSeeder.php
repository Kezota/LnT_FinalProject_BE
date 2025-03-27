<?php

namespace Database\Seeders;

use App\Models\KategoriBarang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriBarang::create(['kategori_barang' => 'Elektronik']);
        KategoriBarang::create(['kategori_barang' => 'Pakaian']);
        KategoriBarang::create(['kategori_barang' => 'Makanan']);
    }
}
