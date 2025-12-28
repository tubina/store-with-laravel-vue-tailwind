<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Repositories\Interfaces\ProductInterface;
use App\Repositories\Eloquent\ProductRepository;

use App\Repositories\Interfaces\CartInterface;
use App\Repositories\Eloquent\CartRepository;

use App\Repositories\Interfaces\FavoriteInterface;
use App\Repositories\Eloquent\FavoriteRepository;

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

        //Favorite 
        $this->app->bind(FavoriteInterface::class, FavoriteRepository::class);
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
