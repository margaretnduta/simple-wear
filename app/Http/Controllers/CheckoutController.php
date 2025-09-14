<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function show()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('status', 'Your cart is empty.');
        }
        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        return view('checkout.show', compact('cart', 'total'));
    }

    public function place(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('status', 'Your cart is empty.');
        }

        $data = $request->validate([
            'customer_name' => ['required','string','max:255'],
            'email'         => ['nullable','email'],
            'phone'         => ['nullable','string','max:50'],
            'address'       => ['nullable','string','max:2000'],
        ]);

        try {
            return DB::transaction(function () use ($cart, $data) {
                // Lock products to ensure consistent stock checks
                $productIds = array_map('intval', array_keys($cart));
                $products   = Product::whereIn('id', $productIds)
                                ->lockForUpdate()
                                ->get()
                                ->keyBy('id');

                // Validate stock and compute total
                $total = 0.0;
                foreach ($cart as $pid => &$item) {
                    if (!isset($products[$pid])) {
                        throw new \Exception("A product in your cart is no longer available (ID: {$pid}).");
                    }
                    $p = $products[$pid];

                    // Cap qty to available stock
                    $desired = (int) $item['qty'];
                    $available = max(0, (int) $p->stock_qty);
                    $finalQty = min($desired, $available);

                    if ($finalQty <= 0) {
                        throw new \Exception("{$p->name} is out of stock.");
                    }

                    // Re-sync cart line to current product data
                    $item['qty']   = $finalQty;
                    $item['price'] = (float) $p->price;
                    $item['name']  = $p->name;

                    $total += $p->price * $finalQty;
                }
                unset($item); // break reference

                // Create order
              $order = Order::create([
    'user_id'       => auth()->id(),
    'customer_name' => $data['customer_name'],
    'email'         => $data['email'] ?? null,
    'phone'         => $data['phone'] ?? null,
    'address'       => $data['address'] ?? null,
    'total'         => $total,
    'status'        => 'pending',
]);

                // Create items + decrement stock
                foreach ($cart as $pid => $item) {
                    $p   = $products[$pid];
                    $qty = (int) $item['qty'];

                    OrderItem::create([
                        'order_id'   => $order->id,
                        'product_id' => $p->id,
                        'name'       => $p->name,
                        'price'      => (float) $p->price,
                        'qty'        => $qty,
                        'subtotal'   => (float) $p->price * $qty,
                    ]);

                    // Deduct stock
                    $p->decrement('stock_qty', $qty);
                }

                // Clear cart after successful order
                session()->forget('cart');

                return redirect()->route('checkout.thankyou', ['order' => $order->id]);
            }, 3);
        } catch (\Throwable $e) {
            // If anything fails, stay on checkout and show the message
            return redirect()->route('checkout.show')
                ->with('status', $e->getMessage());
        }
    }
}
