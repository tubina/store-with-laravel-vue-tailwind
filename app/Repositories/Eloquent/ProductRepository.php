<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Interfaces\ProductInterface;

class ProductRepository implements ProductInterface {
    
    protected $model;

    public function __construct(Product $product) {
        $this->model = $product;
    } 
    
    public function index() {
        return Product::all();
    }
     
    public function show($id) {
        $product = Product::with('productImages')->findOrFail($id);
        return $this->model->with('productImages')->findOrFail($id);
    }  

    public function search(string $term)
    { 
        $search = $this->model  
            ->where('name', 'like', "%{$term}%")
            ->get();
            
        if($search->isEmpty()){
            return $this->index();
        }
        return $search;
    }

}