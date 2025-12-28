<?php

namespace App\Services;

use App\Repositories\Interfaces\FavoriteInterface;
use Illuminate\Support\Facades\Log;

class FavoriteService
{
    protected FavoriteInterface $favoriteInterface;

    public function __construct(FavoriteInterface $favoriteInterface)
    {
        $this->favoriteInterface = $favoriteInterface;
    }

    public function index()
    {
        Log::info('Service: listando favoritos do usuário'); 
        return $this->favoriteInterface->index();
    }

    public function addItemsToFavorite(int $userId, $productsIds)
    {
        try{
            foreach($productsIds as $productId)
            {
                $product = $this->favoriteInterface->addToFavorite($userId, $productId);
                Log::info('Service: adicionando produtos aos favoritos', [
                    'user_id' => $userId,
                    'products_ids' => $productId
                ]);
                try{
                    if($product){
                        Log::info('Foi adicionado!');
                    }  
                }catch(\Exception $e){
                    Log::info($e);
                }
            } 
            return [
                'success' => true,
                'message' => 'Produtos adicionados ao carrinho com sucesso!'
            ];
        }catch(\Exception $e)
        {
            \Log::error($e);

            return [
                'success' => false,
                'message' => 'Erro ao adicionar produto(s) ao favoritos'
            ];
        }
    }

    public function deleteItemsFromFavorite($userId, $productId) {
 
        Log::info('Delete items from cart', [
            'user Id' => $userId
        ]);
        try{
            $productDeleted = $this->favoriteInterface->deleteItemsFromFavorite($userId, $productId);
        }catch(\Exception $e){
            \Log::error($e);

            return [
                'success' => false,
                'message' => 'Erro ao remover produto dos favoritos'
            ];
        }

        return $productDeleted;
    }

}
