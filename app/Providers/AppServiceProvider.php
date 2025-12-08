<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Repositories\Interfaces\ProductInterface;
use App\Repositories\Eloquent\ProductRepository;

use App\Repositories\Interfaces\CartInterface;
use App\Repositories\Eloquent\CartRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         // Product
        $this->app->bind(ProductInterface::class, ProductRepository::class);

        // Cart
        $this->app->bind(CartInterface::class, CartRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
        Gate::policy(Product::class, ProductPolicy::class);
    }
}
