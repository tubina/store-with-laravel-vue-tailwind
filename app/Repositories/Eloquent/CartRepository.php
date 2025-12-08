<?php 

namespace App\Repositories\Eloquent;

use App\Models\Cart;
use App\Repositories\Interfaces\CartInterface;
use Illuminate\Support\Facades\Log;

class CartRepository implements CartInterface{

    protected $model;

    public function __construct(Cart $cart)
    {
        $this->model = $cart;
    }
/**************************************/
    public function index()
    {
        $cart = $this->model::where('user_id', auth()->id())->with('product.category')->with('product.productImagesJustOne')->get();
        return $cart;
    }
/**************************************/
    public function addToCart(int $userId, int $productId)
    {
         $cartItem = $this->model::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
            return $cartItem;
        }

        return Cart::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => 1,
        ]);
    }
/**************************************/

}


