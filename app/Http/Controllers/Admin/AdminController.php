<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $totalOrders   = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $todayOrders   = Order::whereDate('created_at', Carbon::today())->count();
        $totalSales    = Order::sum('total');
        $productsCount = Product::count();

        return view('admin.dashboard', compact(
            'totalOrders','pendingOrders','todayOrders','totalSales','productsCount'
        ));
    }
}
