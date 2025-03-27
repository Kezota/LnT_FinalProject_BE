<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function viewCatalogPage()
    {
        $products = Barang::all();

        foreach ($products as $product) {
            if ($product->jumlah_barang <= 0) {
                $product->delete();
            }
        }

        return view('user.catalog', compact('products'));
    }
}
