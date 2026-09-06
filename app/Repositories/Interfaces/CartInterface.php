<?php

namespace App\Repositories\Interfaces;

interface CartInterface{
    public function index();
    public function addToCart(int $userId, int $productsId);
    public function addQtdCart(int $userId, int $productId);
    public function removeQtdCart(int $userId, int $productId);
    // public function getQtdCart();
    // public function deleteFromCart(int $id);
}

