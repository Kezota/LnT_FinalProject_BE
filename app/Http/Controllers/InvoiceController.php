<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function viewInvoice($invoiceNumber)
    {
        $invoice = Invoice::where('invoice_number', $invoiceNumber)->firstOrFail();
        $items = json_decode($invoice->items, true);

        return view('user.invoice', compact('invoice', 'items'));
    }

    public function viewCheckoutPage()
    {
        $cart = session()->get('cart', []);

        // Check if the cart is empty
        if (empty($cart)) {
            return redirect()->route('user.catalog')->with('error', 'Your cart is empty. Please shop first.');
        }

        return view('user.checkoutProduct', compact('cart'));
    }

    public function viewHistoryPage()
    {
        $invoices = Invoice::where('email', Auth::guard('user')->user()->email)->orderBy('created_at', 'desc')->get();

        return view('user.history', compact('invoices'));
    }

    public function generateInvoice(Request $request)
    {
        $request->validate([
            'alamat_pengiriman' => 'required|string|min:10|max:100',
            'kode_pos' => 'required|string|size:5',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('user.cart')->with('error', 'Your cart is empty. Please shop first.');
        }

        // Save invoice data to the database
        $invoiceNumber = 'INV-' . strtoupper(uniqid());
        $totalPrice = array_sum(array_column($cart, 'subtotal'));
        $items = json_encode($cart);

        Invoice::create([
            'invoice_number' => $invoiceNumber,
            'alamat_pengiriman' => $request->alamat_pengiriman,
            'email' => Auth::guard('user')->user()->email,
            'kode_pos' => $request->kode_pos,
            'items' => $items,
            'total_price' => $totalPrice,
        ]);

        // Clear the cart
        session()->forget('cart');

        return redirect()->route('user.invoice', ['invoiceNumber' => $invoiceNumber]);
    }
}
