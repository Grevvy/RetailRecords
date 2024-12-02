@extends('app')

@section('content')
    <div class="row">
        <h3>{{ $product->name }}</h3>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Price: ${{ number_format($product->price, 2) }}</h5>
            @if ($product->picture)
                <img src="{{ asset('storage/' . $product->picture) }}" alt="{{ $product->name }}" class="img-fluid">
                @endif

            <p class="card-text">{{ $product->description }}</p>
            <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
            <form action="/products/{{ $product->id }}/add-to-cart" method="POST">
                @csrf
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1">
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>



        </div>
    </div>
@endsection
