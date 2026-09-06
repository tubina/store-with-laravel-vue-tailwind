<?php

namespace App\Services;

use App\Repositories\Interfaces\CartInterface;
use Illuminate\Support\Facades\Log;

class CartService {

    protected $cartInterface;

    public function __construct(CartInterface $cartInterface)
    {
        $this->cartInterface = $cartInterface;
    }
/**************************************/
    public function index() 
    {
        return $this->cartInterface->index();
    }
/**************************************/
    public function addItemsToCart(int $userId, $productsId)
    {
        // if (!is_array($productsId)) {
        //     $productsId = [$productsId]; // transforma em array se for 1 produto
        // }
        try {
            foreach($productsId as $productId) {
                $product = $this->cartInterface->addToCart($userId, $productId);
            } 
            return [
                'success' => true,
                'message' => 'Produtos adicionados ao carrinho com sucesso!'
            ];
        } catch (\Exception $e) {
            \Log::error($e);

            return [
                'success' => false,
                'message' => 'Erro ao adicionar produtos ao carrinho'
            ];
        }
    }
/**************************************/
    public function addQtdCart(int $userId, int $productId)
    { 
        try {
            $product = $this->cartInterface->addQtdCart($userId, $productId);
            if ($product) {
                return [
                    'success' => true,
                    'message' => 'Quantidade do produto incrementada com sucesso!'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Produto não encontrado no carrinho'
                ];
            }
        } catch (\Exception $e) {
            \Log::error($e);

            return [
                'success' => false,
                'message' => 'Erro ao incrementar a quantidade do produto no carrinho'
            ];
        }
    }
/**************************************/
    public function removeQtdCart(int $userId, int $productId)
    { 
        try {
            $product = $this->cartInterface->removeQtdCart($userId, $productId);
            if ($product) {
                return [
                    'success' => true,
                    'message' => 'Quantidade do produto decrementada com sucesso!'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Produto não encontrado no carrinho'
                ];
            }
        } catch (\Exception $e) {
            \Log::error($e);

            return [
                'success' => false,
                'message' => 'Erro ao decrementar a quantidade do produto no carrinho'
            ];
        }
    }

 } 