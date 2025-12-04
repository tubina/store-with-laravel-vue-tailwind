<?php 

namespace App\Repositories\Interfaces;

interface ProductInterface {
    public function index($id);
    public function create();
    public function store();
    public function show();
    public function edit();
    public function update();
    public function destroy();
}
