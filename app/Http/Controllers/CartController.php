<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function viewCartPage()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        // Calculate the total price of the cart
        foreach ($cart as $product_id => $item) {
            $cart[$product_id]['subtotal'] = $item['price'] * $item['quantity'];
            $total += $cart[$product_id]['subtotal'];
        }

        return view('user.cart', compact('cart', 'total'));
    }

    public function addToCart(Request $request)
    {
        $product = Barang::find($request->product_id);
        $quantity = $request->quantity;

        // Check if quantity is available in stock
        if ($quantity > $product->jumlah_barang) {
            return redirect()->route('user.catalog')->with('error', 'Quantity exceeds available stock.');
        }

        // Get the cart from the session
        $cart = session()->get('cart', []);

        // If product is already in the cart, update its quantity
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            // If product is not in the cart, add it
            $cart[$product->id] = [
                'name' => $product->nama_barang,
                'price' => $product->harga_barang,
                'quantity' => $quantity,
                'subtotal' => $product->harga_barang * $quantity,
            ];
        }

        // Update stock for that product in the database
        $product->jumlah_barang -= $quantity;
        $product->save();

        // Save the updated cart to the session
        session()->put('cart', $cart);

        return redirect()->route('user.catalog')->with('success', 'Product added to cart successfully.');
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($request->quantity as $product_id => $new_quantity) {
            $product = Barang::find($product_id);

            // Check if the product exists
            if (!$product) {
                return redirect()->route('user.cart')->with('error', 'Product not found.');
            }

            // If quantity is 0, remove the product from the cart
            if ($new_quantity == 0) {
                unset($cart[$product_id]);
                continue;
            }

            // Validate the new quantity does not exceed stock
            $original_quantity = $cart[$product_id]['quantity'];
            $quantity_difference = $new_quantity - $original_quantity;

            if ($quantity_difference > 0 && $quantity_difference > $product->jumlah_barang) {
                return redirect()->route('user.cart')->with('error', 'Quantity for "' . $product->nama_barang . '" exceeds available stock (' . $product->jumlah_barang . ').');
            }

            // Update the stock in the database
            $product->jumlah_barang -= $quantity_difference;
            $product->save();

            // Update the quantity and subtotal in the cart
            $cart[$product_id]['quantity'] = $new_quantity;
            $cart[$product_id]['subtotal'] = $cart[$product_id]['price'] * $new_quantity;
        }

        // Save the updated cart
        session()->put('cart', $cart);

        return redirect()->route('user.cart')->with('success', 'Cart updated successfully.');
    }
}
