<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get category IDs from kategori_barang table
        $elektronik = KategoriBarang::where('kategori_barang', 'Elektronik')->first()->id;
        $pakaian = KategoriBarang::where('kategori_barang', 'Pakaian')->first()->id;
        $makanan = KategoriBarang::where('kategori_barang', 'Makanan')->first()->id;

        // Insert sample products into barangs table
        Barang::create([
            'kategori_barang_id' => $elektronik,
            'nama_barang' => 'Smartphone',
            'harga_barang' => 5000000,
            'jumlah_barang' => 10,
            'foto_barang' => 'smartphone.jpg'
        ]);

        Barang::create([
            'kategori_barang_id' => $pakaian,
            'nama_barang' => 'Kaos Polos',
            'harga_barang' => 100000,
            'jumlah_barang' => 50,
            'foto_barang' => 'kaos.jpg'
        ]);

        Barang::create([
            'kategori_barang_id' => $elektronik,
            'nama_barang' => 'Cas HP',
            'harga_barang' => 75000,
            'jumlah_barang' => 20,
            'foto_barang' => 'cas.jpg'
        ]);

        Barang::create([
            'kategori_barang_id' => $makanan,
            'nama_barang' => 'Mie Instant',
            'harga_barang' => 5000,
            'jumlah_barang' => 100,
            'foto_barang' => 'mie_instant.jpg'
        ]);
    }
}
