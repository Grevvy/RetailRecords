@extends('app')

@section('content')
    <h3>Order Details</h3>
    <p><strong>Order ID:</strong> {{ $order->id }}</p>
    <p><strong>Customer Name:</strong> {{ $order->name }}</p>
    <p><strong>Email:</strong> {{ $order->email }}</p>
    <p><strong>Address:</strong> {{ $order->address }}</p>
    <p><strong>Order Date:</strong> {{ date('F j, Y H:i', strtotime($order->order_date)) }}</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>

    <h4>Order Items</h4>
    <table class="table table-striped table-hover table-sm">
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
