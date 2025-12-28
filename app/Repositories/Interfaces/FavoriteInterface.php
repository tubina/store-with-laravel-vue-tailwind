<?php

namespace App\Repositories\Interfaces;

interface FavoriteInterface {
    public function index();
    public function addToFavorite(int $userId, $productsId);
    public function deleteItemsFromFavorite(int $userId, int $productId);
}