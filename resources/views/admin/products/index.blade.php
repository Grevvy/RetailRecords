@extends('app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>All Products</h3>
        <a href="/admin/products/create" class="btn btn-success">Add New Product</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td class="col-2">
                        @if ($product->picture)
                            <img src="{{ asset('storage/' . $product->picture) }}" alt="{{ $product->name }}" class="img-thumbnail" width="75">
                        @else
                            <span>No Image</span>
                        @endif
                </td>
                    <td>{{ $product->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td>
                        <a href="/admin/products/{{ $product->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                        <form action="/admin/products/{{ $product->id }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
