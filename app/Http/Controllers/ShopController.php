<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function home()
    {
        $latest = Product::orderBy('created_at', 'desc')
            ->take(12)
            ->get();

        return view('shop.home', compact('latest'));
    }

    public function men()
    {
        $products = Product::where('gender', 'men')->latest()->paginate(8);
        return view('shop.men', compact('products'));
    }

    public function women()
    {
        $products = Product::where('gender', 'women')->latest()->paginate(8);
        return view('shop.women', compact('products'));
    }

    /**
     * Product search
     */
    public function search(Request $request)
    {
        $q = trim((string) $request->input('q', ''));

        if ($q === '') {
            return view('shop.search', [
                'q' => $q,
                'products' => collect(),
                'total' => 0,
            ]);
        }

        // split query into words
        $terms = preg_split('/\s+/', $q);

        $query = Product::query();

        $query->where(function ($sub) use ($terms) {
            foreach ($terms as $t) {
                $sub->where(function ($s) use ($t) {
                    $s->where('name', 'LIKE', "%{$t}%")
                      ->orWhere('description', 'LIKE', "%{$t}%");
                });
            }
        });

        // optional gender keywords
        if (in_array(strtolower($q), ['men', 'man', 'mens', 'men’s'])) {
            $query->orWhere('gender', 'men');
        } elseif (in_array(strtolower($q), ['women', 'woman', 'womens', 'women’s'])) {
            $query->orWhere('gender', 'women');
        }

        $products = $query->orderByDesc('created_at')->paginate(12)->withQueryString();
        $total = $products->total();

        return view('shop.search', compact('q', 'products', 'total'));
    }
}
