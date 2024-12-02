@extends('app')

@section('content')
    <h3>Add a New Product</h3>
    <form action="/admin/products" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" id="stock" name="stock" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="picture" class="form-label">Product Image</label>
            <input type="file" id="picture" name="picture" class="form-control" required>
        </div>


        <button type="submit" class="btn btn-success">Add Product</button>
    </form>
@endsection
