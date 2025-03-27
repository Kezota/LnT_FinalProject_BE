@extends('layouts.master')
@section('title', "Cart | PT ChipiChapa")

@section('content')
    <section class="container container-fluid">
        <h1>Your Cart</h1>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session()->has('cart') && count(session('cart')) > 0)
            <form action="{{ route('user.updateCart') }}" method="POST">
                @csrf
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(session('cart') as $product_id => $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>Rp. {{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td>
                                <input type="number" name="quantity[{{ $product_id }}]" value="{{ $item['quantity'] }}" min="0" class="form-control">
                            </td>
                            <td>Rp. {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                            <td>
                                <button type="submit" class="btn btn-warning">Update</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between mt-4">
                    <h5>Total: Rp. {{ number_format($total, 0, ',', '.') }}</h5>
                    <a href="{{ route('user.checkoutProduct') }}" class="btn btn-primary">Proceed to Checkout</a>
                </div>
            </form>
        @else
            <p>Your cart is empty. <a href="{{ route('user.catalog') }}">Shop now</a></p>
        @endif
    </section>
@endsection
