<?php

namespace App\Repositories\Eloquent;
use Illuminate\Support\Facades\Log;
use App\Repositories\Interfaces\FavoriteInterface;
use App\Models\Favorite;

class FavoriteRepository implements FavoriteInterface {

    
    public function index() {
        Log::info('usuario repositorie index');
        $user = auth()->user();
        $favorites = $user->favoriteProducts()->with('productImagesJustOne')->get();
        return $favorites;
    }

    public function addToFavorite(int $userId, $productId) {
        Log::info('usuario repositorie addtofavorite');

        $favoriteItem = Favorite::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();
        if($favoriteItem)
        {
            throw new \DomainException('Produto ja esta nos favoritos');
        } 
        return Favorite::create([
            'user_id' => $userId,
            'product_id' => $productId
        ]);   
    }

    public function deleteItemsFromFavorite(int $userId, int $productId){
        $productDeleted = Favorite::where('user_id', $userId)
        ->where('product_id', $productId)
        ->delete();

        return $productDeleted;
    }

}
