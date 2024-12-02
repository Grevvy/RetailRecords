<?php

use Illuminate\Support\Facades\Route;

// Home Page
Route::get('/', ['uses' => '\App\Http\Controllers\ProductController@index']);

// Product Routes
Route::get('/products/{product_id}', ['uses' => '\App\Http\Controllers\ProductController@show']);
Route::post('/products/{product_id}/add-to-cart/', ['uses' => '\App\Http\Controllers\CartItemController@store']);

// Cart Routes
Route::get('/cart', ['uses' => '\App\Http\Controllers\CartController@show']);
Route::post('/cart/checkout', ['uses' => '\App\Http\Controllers\OrderController@store']);
Route::get('/cart/checkout', [\App\Http\Controllers\CartController::class, 'checkout']);
Route::delete('/cart/remove/{product_id}', [\App\Http\Controllers\CartItemController::class, 'destroy']);

// Route to display the order confirmation page
Route::get('/orders/confirmation/{order_id}', [\App\Http\Controllers\OrderController::class, 'show'])->name('orders.confirmation');

// Customer Account Routes
Route::get('/account/{customer_id}', ['uses' => '\App\Http\Controllers\CustomerController@show']);
Route::post('/account/{customer_id}/update', ['uses' => '\App\Http\Controllers\CustomerController@update']);

// Admin Routes - Products
Route::get('/admin/products', [\App\Http\Controllers\ProductController::class, 'adminIndex'])->name('admin.products.index');
Route::get('/admin/products/create', [\App\Http\Controllers\ProductController::class, 'create'])->name('admin.products.create');
Route::post('/admin/products', [\App\Http\Controllers\ProductController::class, 'store'])->name('admin.products.store');
Route::get('/admin/products/{product}/edit', [\App\Http\Controllers\ProductController::class, 'edit'])->name('admin.products.edit');
Route::patch('/admin/products/{product}', [\App\Http\Controllers\ProductController::class, 'update'])->name('admin.products.update');
Route::delete('/admin/products/{product}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('admin.products.destroy');
Route::get('/admin/orders/{order}', [\App\Http\Controllers\OrderController::class, 'show'])->name('admin.orders.show');


// Admin Routes for Orders
Route::get('/admin/orders', ['uses' => '\App\Http\Controllers\OrderController@index']);
Route::patch('/admin/orders/{order}/update', [\App\Http\Controllers\OrderController::class, 'updateStatus']);


/*
Additional Routes (if needed for future expansion):
- Route::get('/categories', ['uses' => '\App\Http\Controllers\CategoryController@index']);
- Route::post('/categories', ['uses' => '\App\Http\Controllers\CategoryController@store']);
*/
