<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $men   = Product::where('gender','men')->orderBy('type')->orderBy('name')->get();
        $women = Product::where('gender','women')->orderBy('type')->orderBy('name')->get();

        return view('admin.products.index', compact('men','women'));
    }
}
