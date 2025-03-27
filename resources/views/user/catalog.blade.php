@extends('layouts.master')
@section('title', "Catalog | PT ChipiChapa")

@section('content')
    <section class="container container-fluid">
        <h1>Catalog Page</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row flex">
            @foreach($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card" style="width: 16rem;">
                    <img src="{{ asset('storage/barang_images' . $product->foto_barang) }}" class="card-img-top" alt="{{ $product->nama_barang }}" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->nama_barang }}</h5>
                        <p class="card-text">Rp. {{ number_format($product->harga_barang, 0, ',', '.') }}</p>
                        <p class="card-text">Stok: {{ $product->jumlah_barang }}</p>
                        <form action="{{ route('user.addToCart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="number" name="quantity" min="1" max="{{ $product->jumlah_barang }}" value="1" required class="form-control mb-2">
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
@endsection
