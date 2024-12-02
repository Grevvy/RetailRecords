@extends('app')

@section('content')
    <h3>All Orders</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Total Amount</th>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Items</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ date('F j, Y H:i', strtotime($order->order_date)) }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>${{ number_format($order->total_amount, 2) }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->address }}</td>
                    <td>
                        <ul>
                            @foreach ($order->orderItems as $item)
                                <li>{{ $item->quantity }}x {{ $item->product->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <!-- View Details Button -->
                        <a href="/admin/orders/{{ $order->id }}" class="btn btn-info btn-sm mb-2">View Details</a>

                        <!-- Update Status Form -->
                        <form action="/admin/orders/{{ $order->id }}/update" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="form-select form-select-sm" required>
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Update</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
