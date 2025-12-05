<?php 

namespace App\Repositories\Interfaces;

interface ProductInterface {  
    public function index();
    public function show(int $id);
    public function search(string $arr);
    //create e edit it shouldn't be here because in most cases it only returns a view.
}
