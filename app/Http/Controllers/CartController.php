<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the cart.
     */
    public function show()
    {
        $cart = session()->get('cart', []);

        // Fetch product details for each cart item
        $cartDetails = collect($cart)->map(function ($item) {
            $product = \App\Models\Product::find($item['product_id']);
            return [
                'product' => $product,
                'quantity' => $item['quantity'],
                'subtotal' => $item['quantity'] * $product->price,
            ];
        });

        // Calculate total price
        $totalPrice = $cartDetails->sum('subtotal');

        return view('cart.show', [
            'cartDetails' => $cartDetails,
            'totalPrice' => $totalPrice,
        ]);
    }

    /**
     * Display the checkout form.
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        return view('cart.checkout');
    }
}
