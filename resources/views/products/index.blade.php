@extends('app')

@section('content')
    <div class="row">
        <h3>Products</h3>
    </div>
    <br>
    <table class="table table-striped table-hover table-sm">
        <thead class="thead-dark">
        <tr class="d-flex">
            <th scope="col" class="col-2">Image</th>
            <th scope="col" class="col-3">Product Name</th>
            <th scope="col" class="col-3">Description</th>
            <th scope="col" class="col-1">Price</th>
            <th scope="col" class="col-1">Stock</th>
            <th scope="col" class="col-2">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr class="d-flex">
                <td class="col-2">
                    @if ($product->picture)
                        <img src="{{ asset('storage/' . $product->picture) }}" alt="{{ $product->name }}" class="img-thumbnail" width="75">
                    @else
                        <span>No Image</span>
                    @endif
                </td>
                <td class="col-3">{{ $product->name }}</td>
                <td class="col-3">{{ Str::limit($product->description, 50) }}</td> <!-- Shorten description -->
                <td class="col-1">${{ number_format($product->price, 2) }}</td>
                <td class="col-1">{{ $product->stock }}</td>
                <td class="col-2 d-flex justify-content-between">
                    <a href="/products/{{ $product->id }}" class="btn btn-info">View Product</a> <!-- Details page link -->
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
