<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/home', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'storeteste' => Route::has('store')
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/store', [StoreController::class, 'index'])->name('store');

Route::get('/product/{id}', [ProductController::class, 'index'])->name('product');

Route::get('/cart', function(){
    return Inertia::render('Cart');
});

Route::get('/favorite', function(){
    return Inertia::render('Favorite', ['name'=>'fefllilpe']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/photo', [ProfileController::class, 'editPhoto'])->name('profile.editPhoto');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    /***********/
    Route::get('/cart', [CartController::class, 'index'])->name('index.cart');
    Route::get('/cart-get', [CartController::class, 'getQtdCart'])->name('get.cart');
    Route::post('/cart-insert', [CartController::class, 'addToCart'])->name('add.cart');
    Route::delete('/cart-delete', [CartController::class, 'deleteFromCart'])->name('delete.cart');
    /***********/
    Route::get('/favorite', [FavoriteController::class, 'index'])->name('index.favorite');
    Route::get('/favorite-get', [FavoriteController::class, 'getQtdFavorite'])->name('get.favorite');
    Route::post('/favorite-insert', [FavoriteController::class, 'addToFavorite'])->name('add.favorite');
    /***********/
    /***********/

});

Route::get('/phpinfo', function () {
    phpinfo();
});
/**********************************************************************/
 Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/admin/category', [CategoryAdminController::class, 'index'])->name('admin.category');
    Route::patch('/admin/categoryEdit/{id}', [CategoryAdminController::class, 'update'])->name('admin.edit.category');
    Route::post('/admin/add-category', [CategoryAdminController::class, 'save'])->name('admin.edit.category');
    /****************************/
    Route::get('/admin/product', [ProductAdminController::class, 'index'])->name('admin.product');
    Route::post('admin/add-product', [ProductAdminController::class, 'store'])->name('admin.store.product');
    Route::get('admin/add-product', [ProductAdminController::class, 'create'])->name('admin.add.product');
    Route::get('admin/edit-product/{product}', [ProductAdminController::class, 'edit'])->name('admin.edit.product');
    Route::patch('admin/update-product/{product}', [ProductAdminController::class, 'update'])->name('admin.update.product');
    //Route::match(['post', 'patch'], '/admin/update-product-photo', [ProductAdminController::class, 'editOnePhoto'])->name('admin.update.photo.product');
    Route::post('/admin/update-teste', [ProductAdminController::class, 'teste']);
    Route::delete('/profile/deletePhoto/{id}', [ProductAdminController::class, 'deletePhoto'])->name('profile.deletePhoto');

    Route::fallback(function () {
        return Inertia::render('Admin/ProductAdd');
    });
});
/**********************************************************************/
/**********************************************************************/

require __DIR__.'/auth.php';
