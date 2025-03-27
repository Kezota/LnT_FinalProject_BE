@extends('layouts.master')
@section('title', 'Checkout | PT ChipiChapa')

@section('content')
    <section class="container container-fluid">
        <h1>Checkout</h1>

        @if(!session()->has('cart') || count(session('cart')) === 0)
            <div class="alert alert-info mt-3">
                You have no items in your cart. <a href="{{ route('user.catalog') }}">Shop now</a>.
            </div>
        @else
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('user.generateInvoice') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="alamat_pengiriman" class="form-label">Shipping Address</label>
                    <input type="text" name="alamat_pengiriman" id="alamat_pengiriman" class="form-control" required minlength="10" maxlength="100">
                </div>
                <div class="mb-3">
                    <label for="kode_pos" class="form-label">Postal Code</label>
                    <input type="text" name="kode_pos" id="kode_pos" class="form-control" required minlength="5" maxlength="5">
                </div>
                <button type="submit" class="btn btn-success">Generate Invoice</button>
                <a href="{{ route('user.cart') }}" class="btn btn-secondary">Back to Cart</a>
            </form>
        @endif
    </section>
@endsection