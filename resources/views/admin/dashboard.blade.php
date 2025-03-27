@extends('layouts.master')
@section('title', "Dashboard | PT ChipiChapa")

@section('content')
    <section class="container container-fluid">
        <h1>Dashboard Page</h1>
        <a href="{{ route('admin.addProduct') }}" class="btn btn-primary">Tambah Produk</a>

        @if(session('success'))
        <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $item)
                    <tr class="align-middle">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->kategori->kategori_barang }}</td>
                        <td>Rp. {{ number_format($item->harga_barang, 0, ',', '.') }}</td>
                        <td>{{ $item->jumlah_barang }}</td>
                        <td><img src="{{ asset('storage/barang_images/' . $item->foto_barang) }}" alt="Foto Barang" width="70" height="70"></td>
                        <td>
                            <a href="{{ route('admin.editProduct', $item->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ url('admin/delete-product/' . $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
