<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $invoice->invoice_number }} | PT ChipiChapa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-4">Invoice: {{ $invoice->invoice_number }}</h2>
                <p><strong>Shipping Address:</strong> {{ $invoice->alamat_pengiriman }}</p>
                <p><strong>Postal Code:</strong> {{ $invoice->kode_pos }}</p>
                <p><strong>Email:</strong> {{ $invoice->email }}</p>
                <p><strong>Generated On:</strong> {{ now()->format('d M Y, H:i') }}</p>

                <table class="table table-bordered mt-4">
                    <thead class="thead-dark">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>Rp. {{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <h4 class="text-end">Total: Rp. {{ number_format($invoice->total_price, 0, ',', '.') }}</h4>
                <a href="{{ route('user.catalog') }}" class="btn btn-primary mb-4">Back to Catalog</a>
            </div>
        </div>
    </div>
    
</body>
</html>
