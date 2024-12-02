<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Facade;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index', ['products' => Product::all()]);
    }

    public function show($product_id)
    {
        return view('products.show', ['product' => Product::find($product_id)]);
    }

    public function create()
    {
        $categories = \App\Models\Category::all(); // Fetch categories for the dropdown
        return view('admin.products.create', ['categories' => $categories]);
    }
    

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'category_id' => 'nullable|exists:categories,id',
        'picture' => 'nullable|string|max:255', // Validate image path
    ]);

    \App\Models\Product::create($request->all());

    return redirect('/admin/products')->with('success', 'Product added successfully!');
}




public function edit($id)
{
    $product = \App\Models\Product::findOrFail($id); // Fetch the product
    $categories = \App\Models\Category::all(); // Fetch categories for the dropdown

    return view('admin.products.edit', [
        'product' => $product,
        'categories' => $categories,
    ]);
}


public function update(Request $request, $id)
{
    $product = \App\Models\Product::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'category_id' => 'nullable|exists:categories,id',
        'picture' => 'nullable|string|max:255', // Validate image path
    ]);

    $product->update($request->all());

    return redirect('/admin/products')->with('success', 'Product updated successfully!');
}




public function destroy($id)
{
    $product = \App\Models\Product::findOrFail($id);

    $product->delete();

    return redirect('/admin/products')->with('success', 'Product deleted successfully!');
}


    public function adminIndex()
{
    // Fetch all products
    $products = \App\Models\Product::all();

    return view('admin.products.index', [
        'products' => $products,
    ]);
}

}
