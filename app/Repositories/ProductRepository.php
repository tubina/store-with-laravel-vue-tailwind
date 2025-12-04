<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductInterface;

class ProductRepository implements ProductInterface {
    
    protected $model;

    public function __construct(Product $product) {
        $this->model = $product;
    }

    public function index($id) {
        $product = Product::with('productImages')->findOrFail($id);
        return $this->model->with('productImages')->findOrFail($id);
    }
    public function create(){

    }
    public function store(){

    }
    public function show(){

    }
    public function edit(){

    }
    public function update(){

    }
    public function destroy(){

    }

}