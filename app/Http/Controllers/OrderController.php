<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index', ['orders' => Order::all()]);
    }

    public function show($order_id)
    {
    // Fetch the order and related items
    $order = \App\Models\Order::with('orderItems.product')->findOrFail($order_id);

    return view('orders.confirmation', [
        'order' => $order,
    ]);
    }


    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
{
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }

    // Validate checkout form data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'address' => 'required|string|max:500',
        'payment' => 'required|string|in:credit_card,paypal,cash_on_delivery',
    ]);

    // Calculate total amount
    $totalAmount = collect($cart)->sum(function ($item) {
        $product = \App\Models\Product::find($item['product_id']);
        return $item['quantity'] * $product->price;
    });

    // Create the order
    $order = \App\Models\Order::create([
        'order_date' => now(),
        'status' => 'pending',
        'total_amount' => $totalAmount,
        'name' => $request->name,
        'email' => $request->email,
        'address' => $request->address,
        'payment_method' => $request->payment,
    ]);

    // Add items to the order
    foreach ($cart as $item) {
        \App\Models\OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'unit_price' => \App\Models\Product::find($item['product_id'])->price,
        ]);
    }

    // Clear the cart
    session()->forget('cart');

    // Redirect to the order confirmation page
    return redirect()->route('orders.confirmation', ['order_id' => $order->id]);
}



    public function edit($order_id)
    {
        return view('orders.edit', ['order' => Order::find($order_id)]);
    }

    public function update(Request $request, $order_id)
    {
        $order = Order::find($order_id);
        $order->update($request->only(['customer_id', 'order_date', 'status', 'total_amount']));
        return redirect()->route('orders.index');
    }

    public function destroy($order_id)
    {
        Order::destroy($order_id);
        return redirect()->route('orders.index');
    }

    public function adminIndex()
{
    // Fetch all orders with their related items
    $orders = \App\Models\Order::with('orderItems.product')->orderBy('order_date', 'desc')->get();

    return view('admin.orders.index', [
        'orders' => $orders,
    ]);
}

public function updateStatus(Request $request, $order_id)
{
    $order = \App\Models\Order::findOrFail($order_id);

    $request->validate([
        'status' => 'required|string|in:pending,completed,cancelled',
    ]);

    $order->status = $request->status;
    $order->save();

    return redirect()->back()->with('success', 'Order status updated successfully.');
}




}
