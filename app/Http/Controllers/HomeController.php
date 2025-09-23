<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $category = Category::get();
        $products = Product::with(['category', 'productImagesJustOne'])->get();

        // if($products->isEmpty())
        // {
        //     return Inertia::render('Home', [
        //         'products' => '/proucts/0gZRgIN8zOfghOHZph6UK926PY3kDbMFveBxkat2.jpg'
        //     ]);
        // }
        return Inertia::render('Home', [
            'category' => $category,
            'products' => $products
        ]);

    }
}
