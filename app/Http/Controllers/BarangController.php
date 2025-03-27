<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function dashboard()
    {
        $barang = Barang::with('kategori')->get();
        return view('admin.dashboard', compact('barang'));
    }

    public function addProduct()
    {
        $kategori = KategoriBarang::all();
        return view('admin.addProduct', compact('kategori'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'kategori_barang_id' => 'required|exists:kategori_barang,id',
            'nama_barang' => 'required|string|min:5|max:80',
            'harga_barang' => 'required|integer|min:1',
            'jumlah_barang' => 'required|integer|min:1',
            'foto_barang' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $foto_barang = null;
        if ($request->hasFile('foto_barang')) {
            $currentDateTime = now()->format('Y-m-d_H-i-s');

            $foto_barang = $request->file('foto_barang')->storeAs(
                'public/barang_images',
                $currentDateTime . '.' . $request->file('foto_barang')->getClientOriginalExtension()
            );
        }

        Barang::create([
            'kategori_barang_id' => $request->kategori_barang_id,
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'foto_barang' => $foto_barang,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Barang berhasil ditambahkan');
    }

    public function editProduct($id)
    {
        $barang = Barang::findOrFail($id);
        $kategori = KategoriBarang::all();
        return view('admin.editProduct', compact('barang', 'kategori'));
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'kategori_barang_id' => 'required|exists:kategori_barang,id',
            'nama_barang' => 'required|string|min:5|max:80',
            'harga_barang' => 'required|integer|min:1',
            'jumlah_barang' => 'required|integer|min:1',
            'foto_barang' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $barang = Barang::findOrFail($id);  // Find the product to update

        // Update the photo if a new one is uploaded
        if ($request->hasFile('foto_barang')) {
            $currentDateTime = now()->format('Y-m-d_H-i-s');

            $foto_barang = $request->file('foto_barang')->storeAs(
                'public/barang_images',
                $currentDateTime . '.' . $request->file('foto_barang')->getClientOriginalExtension()
            );

            if ($barang->foto_barang) {
                Storage::delete($barang->foto_barang);
            }
        } else {
            $foto_barang = $barang->foto_barang;
        }

        // Update the product details
        $barang->update([
            'kategori_barang_id' => $request->kategori_barang_id,
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'foto_barang' => $foto_barang,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Barang berhasil diupdate');
    }

    public function deleteProduct($id)
    {
        $barang = Barang::findOrFail($id);

        // Delete the photo if it exists
        if ($barang->foto_barang) {
            Storage::delete($barang->foto_barang);
        }

        // Delete the product
        $barang->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Barang berhasil dihapus');
    }
}
