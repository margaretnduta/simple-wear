<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart  = session('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        // Normalize and cap requested qty by current stock
        $qty = max(1, (int) $request->input('qty', 1));
        $qty = min($qty, max(0, (int) $product->stock_qty));

        if ($qty === 0) {
            return back()->with('status', 'This item is out of stock.');
        }

        $cart = session('cart', []);

        // Merge with existing quantity, still capped by stock
        $existingQty = isset($cart[$product->id]) ? (int) $cart[$product->id]['qty'] : 0;
        $newQty = min($existingQty + $qty, (int) $product->stock_qty);

        $cart[$product->id] = [
            'name'   => $product->name,
            'type'   => $product->type,          // include type
            'price'  => (float) $product->price,
            'qty'    => $newQty,
            'image'  => $product->image_path,
            'gender' => $product->gender,
        ];

        session(['cart' => $cart]);

        return back()->with('status', 'Added to cart.');
    }

    public function update(Request $request, Product $product)
    {
        $cart = session('cart', []);

        if (!isset($cart[$product->id])) {
            return back()->with('status', 'Item not found in cart.');
        }

        $qty = max(1, (int) $request->input('qty', 1));
        // Cap by current stock
        $qty = min($qty, max(0, (int) $product->stock_qty));

        if ($qty === 0) {
            // If somehow stock is now 0, remove it from cart
            unset($cart[$product->id]);
            session(['cart' => $cart]);
            return back()->with('status', 'Item removed (out of stock).');
        }

        $cart[$product->id]['qty'] = $qty;
        session(['cart' => $cart]);

        return back()->with('status', 'Cart updated.');
    }

    public function remove(Product $product)
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);
        return back()->with('status', 'Item removed.');
    }

    public function clear()
    {
        session()->forget('cart');
        return back()->with('status', 'Cart cleared.');
    }
}
