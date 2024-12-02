@extends('app')

@section('content')
    <h3>Thank You for Shopping with Retail Records!</h3>
    <p>Your order has been successfully placed. Below are the details of your order:</p>

    <h5>Order Summary</h5>
    <p><strong>Order ID:</strong> {{ $order->id }}</p>
    <p><strong>Order Date:</strong> {{ $order->order_date}}</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>

    <h5>Shipping Information</h5>
    <p><strong>Name:</strong> {{ $order->name }}</p>
    <p><strong>Email:</strong> {{ $order->email }}</p>
    <p><strong>Address:</strong> {{ $order->address }}</p>

    <h5>Order Items</h5>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->unit_price, 2) }}</td>
                    <td>${{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
