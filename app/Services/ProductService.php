<?php 

namespace App\Services;

use App\Repositories\Interfaces\ProductInterface;

class ProductService {

    protected $productInterface;

    public function __construct(ProductInterface $productInterface) {
        $this->productInterface = $productInterface;
    }

    public function index($id) { 
        return $this->productInterface->index($id);
    }


}