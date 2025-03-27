<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';

    protected $fillable = [
        'kategori_barang_id',
        'nama_barang',
        'harga_barang',
        'jumlah_barang',
        'foto_barang'
    ];

    // One to Many relationship with KategoriBarang
    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_barang_id');
    }
}
