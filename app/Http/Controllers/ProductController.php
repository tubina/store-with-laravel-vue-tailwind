<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\ProductService;

class ProductController extends Controller
{

    protected $productService;

    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }
 
    
    public function index()
    {
        return $this->productService->index();
    }


    public function show(int $id)
    {
        $product = $this->productService->show($id);
        return Inertia::render('Product', ['product' => $product]);
    } 
 
 
    public function search(Request $request)
    { 
        $search = $this->productService->search($request); 
        return response()->json($search->values());
    }
}
