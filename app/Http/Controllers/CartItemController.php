<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartItemController extends Controller
{
    public function store(Request $request, $product_id)
    {
        $quantity = $request->input('quantity', 1);

        if ($quantity < 1) {
            return redirect()->back()->with('error', 'Quantity must be at least 1.');
        }

        $product = Product::findOrFail($product_id);

        // Get the current cart from the session, or initialize it
        $cart = session()->get('cart', []);

        // Check if the product already exists in the cart
        $index = collect($cart)->search(fn($item) => $item['product_id'] == $product_id);

        if ($index !== false) {
            // Update the quantity
            $cart[$index]['quantity'] += $quantity;
        } else {
            // Add the product to the cart
            $cart[] = [
                'product_id' => $product->id,
                'quantity' => $quantity,
            ];
        }

        // Update the cart in the session
        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function destroy($product_id)
{
    // Retrieve the current cart from the session
    $cart = session()->get('cart', []);

    // Filter out the product to be removed
    $cart = collect($cart)->reject(fn($item) => $item['product_id'] == $product_id)->toArray();

    // Update the cart in the session
    session(['cart' => $cart]);

    return redirect()->back()->with('success', 'Item removed from cart.');
}

}
