@extends('app')

@section('content')
    <h3>Edit Product</h3>
    <form action="/admin/products/{{ $product->id }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01" value="{{ $product->price }}" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" id="stock" name="stock" class="form-control" value="{{ $product->stock }}" required>
        </div>
        <div class="mb-3">
            <label for="picture" class="form-label">Product Image</label>
            <input type="file" id="picture" name="picture" class="form-control">
            @if ($product->picture)
                <img src="{{ asset('storage/' . $product->picture) }}" alt="Product Image" class="img-thumbnail mt-2" width="150">
            @endif
        </div>



        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
@endsection
