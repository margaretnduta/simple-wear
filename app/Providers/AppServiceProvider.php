<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share cart item count with all Blade views
        View::composer('*', function ($view) {
            $cart = session('cart', []);
            // Sum qty safely
            $cartCount = 0;
            if (is_array($cart)) {
                foreach ($cart as $item) {
                    $cartCount += (int) ($item['qty'] ?? 0);
                }
            }
            $view->with('cartCount', $cartCount);
        });
    }
}
