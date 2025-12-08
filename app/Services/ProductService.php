<?php 

namespace App\Services;

use App\Repositories\Interfaces\ProductInterface;
use Illuminate\Support\Facades\Log;

class ProductService {

    protected $productInterface;

    public function __construct(ProductInterface $productInterface) {
        $this->productInterface = $productInterface;
    }
    
/******************************************/
    public function index() {
        return $this->productInterface->index();
    }
/******************************************/ 
    public function show($id) {
        return $this->productInterface->show($id);
    }
/******************************************/
    public function search($request)
    {
        $searchTerm = $request->input('name'); 
        $search = $this->productInterface->search($searchTerm);

        //        Log::info('Q....: '.$request);
        Log::info('Quantidade de resultados do search: '.$search->count());
        Log::info('Quantidade de produtos do index: '.$this->productInterface->index()->count());

        return $search;
    }


}