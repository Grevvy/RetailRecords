@extends('app')

@section('content')
    <h3>Checkout</h3>
    <form action="/cart/checkout" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Shipping Address</label>
            <textarea id="address" name="address" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="payment" class="form-label">Payment Method</label>
            <select id="payment" name="payment" class="form-select" required>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
                <option value="cash_on_delivery">Cash on Delivery</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Place Order</button>
    </form>
@endsection
