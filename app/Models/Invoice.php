<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public $table = 'invoices';

    protected $fillable = ['invoice_number', 'alamat_pengiriman', 'kode_pos', 'email', 'items', 'total_price'];
}
