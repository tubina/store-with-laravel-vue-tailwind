<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;

class StoreController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'productImagesJustOne'])->get();
        return Inertia::render('Store', ['products' => $products]);
    }
}
