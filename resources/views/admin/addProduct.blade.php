@extends('layouts.master')
@section('title', "Add Product | PT ChipiChapa")

@section('content')
    <section class="container container-fluid">
        <h1>Add Product Page</h1>

        <form method="POST" action="{{ url('admin/store-product') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="kategori_barang_id" class="form-label">Kategori Barang</label>
                <select name="kategori_barang_id" class="form-control" required>
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat->id }}">{{ $kat->kategori_barang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" required minlength="5" maxlength="80">
            </div>
            <div class="mb-3">
                <label for="harga_barang" class="form-label">Harga Barang (Rp.)</label>
                <input type="number" name="harga_barang" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                <input type="number" name="jumlah_barang" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="foto_barang" class="form-label">Foto Barang</label>
                <input type="file" name="foto_barang" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Tambah Barang</button>
        </form>
    </section>
@endsection
