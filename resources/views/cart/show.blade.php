@extends('app')

@section('content')
    <h3>Your Cart</h3>
    @if ($cartDetails->isNotEmpty())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartDetails as $item)
                    <tr>
                        <td>{{ $item['product']->name }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>${{ number_format($item['product']->price, 2) }}</td>
                        <td>${{ number_format($item['subtotal'], 2) }}</td>
                        <td>
                            <form action="/cart/remove/{{ $item['product']->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p><strong>Total Price: </strong> ${{ number_format($totalPrice, 2) }}</p>

        <form action="/cart/checkout" method="GET">
            @csrf
            <button type="submit" class="btn btn-success">Proceed to Checkout</button>
        </form>
    @else
        <p>Your cart is empty.</p>
    @endif
@endsection
