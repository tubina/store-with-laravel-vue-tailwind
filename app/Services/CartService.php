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
    // public function addToCart($request)    { 
    //     if(is_array($request->input('product_id')))
    //     {
    //         foreach($items as $item){
    //             $cart = $this->cartInterface->addTocart();
               
    //             if($cartItem){
    //                 $cartItem->quantity = $cartItem->quantity + 1;
    //                 $carItem->save();
    //             }else{
    //                 $cart = new Cart();
    //                 $cart->user_id = $user;
    //                 $cart->product_id = $item;
    //                 $cart->save();
    //             }
    //         }
    //         return response()->json(['data'=> $items]);

    //     }else{
    //         try{
    //         $cartItem = Cart::where('user_id', $user)
    //                 ->where('product_id', $product_id)
    //                 ->first();
    //         if($cartItem)
    //         {
    //             $cartItem->quantity = $cartItem->quantity + 1;
    //             $cartItem->save();
    //         }else {
    //             $cart = new Cart();
    //             $cart->user_id = $user;
    //             $cart->product_id = $product_id;
    //             $cart->save();
    //         }
    //         }catch(\Exception $e){
    //             \Log::error($e); // Aqui você verá o erro no log
    //             return response()->json(['message' => 'Erro no servidor'], 500);
    //         }
    //     }

    //     return response()->json(['message' => 'Produto adicionado ao carrinho com sucesso!']);

    //     Log::info('Usuario Service', $product_id);

    //     return $this->cartInterface->addToCart($request);
    // }
    
     

}