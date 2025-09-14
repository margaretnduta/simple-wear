<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        // Create/edit/delete are protected by ['auth','admin'] in routes
    }

    public function create()
    {
        $gender = request('gender');
        return view('products.create', compact('gender'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required','string','max:255'],
            'type'        => ['nullable','string','max:255'],   // NEW
            'gender'      => ['required','in:men,women'],
            'price'       => ['required','numeric','min:0'],
            'stock_qty'   => ['required','integer','min:0'],    // NEW
            'description' => ['nullable','string'],
            'image'       => ['nullable','image','max:2048'],
        ]);

        $path = $request->hasFile('image')
            ? $request->file('image')->store('products', 'public')
            : null;

        Product::create([
            'name'        => $validated['name'],
            'type'        => $validated['type'] ?? null,        // NEW
            'gender'      => $validated['gender'],
            'price'       => $validated['price'],
            'stock_qty'   => $validated['stock_qty'],           // NEW
            'description' => $validated['description'] ?? null,
            'image_path'  => $path,
        ]);

        return redirect()->route($validated['gender'] === 'men' ? 'men' : 'women')
            ->with('status', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => ['required','string','max:255'],
            'type'        => ['nullable','string','max:255'],   // NEW
            'gender'      => ['required','in:men,women'],
            'price'       => ['required','numeric','min:0'],
            'stock_qty'   => ['required','integer','min:0'],    // NEW
            'description' => ['nullable','string'],
            'image'       => ['nullable','image','max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $product->image_path = $request->file('image')->store('products', 'public');
        }

        $product->fill([
            'name'        => $validated['name'],
            'type'        => $validated['type'] ?? null,        // NEW
            'gender'      => $validated['gender'],
            'price'       => $validated['price'],
            'stock_qty'   => $validated['stock_qty'],           // NEW
            'description' => $validated['description'] ?? null,
        ])->save();

        return redirect()->route($validated['gender'] === 'men' ? 'men' : 'women')
            ->with('status', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $gender = $product->gender;
        $product->delete();

        return redirect()->route($gender === 'men' ? 'men' : 'women')
            ->with('status', 'Product deleted.');
    }
}
