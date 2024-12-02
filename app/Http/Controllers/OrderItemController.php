<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;

class OrderItemController extends Controller
{
    public function store(Request $request)
    {
        OrderItem::create($request->only(['order_id', 'product_id', 'quantity', 'unit_price']));
        return back()->with('success', 'Item added to order.');
    }

    public function destroy($order_item_id)
    {
        OrderItem::destroy($order_item_id);
        return back()->with('success', 'Item removed from order.');
    }
}
