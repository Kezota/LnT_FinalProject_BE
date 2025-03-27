@extends('layouts.master')
@section('title', 'Invoice History | PT ChipiChapa')

@section('content')
    <section class="container container-fluid mt-4">
        <h1>Invoice History</h1>

        @if($invoices->isEmpty())
            <div class="alert alert-info mt-3">
                You have no invoices yet. <a href="{{ route('user.cart') }}">Checkout now</a>.
            </div>
        @else
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Invoice Number</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->created_at->format('d M Y, H:i') }}</td>
                            <td>{{ $invoice->invoice_number }}</td>
                            <td>Rp. {{ number_format($invoice->total_price, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('user.invoice', ['invoiceNumber' => $invoice->invoice_number]) }}" class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </section>
@endsection