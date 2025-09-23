<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('product')->get();

        return Inertia::render('Cart', ['cart' => $cart]);
    }
/**************************************************/
    public function addToCart(Request $request)
    {
        $user = $request->user()->id;
        $product_id = $request->product_id;
        $items = $request->input('product_id');

        if(is_array($request->input('product_id')))
        {
            foreach($items as $item){
                $cartItem = Cart::where('user_id', $user)
                    ->where('product_id', $item)
                    ->first();
                if($cartItem){
                    $cartItem->quantity = $cartItem->quantity + 1;
                    $carItem->save();
                }else{
                    $cart = new Cart();
                    $cart->user_id = $user;
                    $cart->product_id = $item;
                    $cart->save();
                }
            }
            return response()->json(['data'=> $items]);

        }else{
            try{
            $cartItem = Cart::where('user_id', $user)
                    ->where('product_id', $product_id)
                    ->first();
            if($cartItem)
            {
                $cartItem->quantity = $cartItem->quantity + 1;
                $cartItem->save();
            }else {
                $cart = new Cart();
                $cart->user_id = $user;
                $cart->product_id = $product_id;
                $cart->save();
            }
            }catch(\Exception $e){
                \Log::error($e); // Aqui você verá o erro no log
                return response()->json(['message' => 'Erro no servidor'], 500);
            }
        }

        return response()->json(['message' => 'Produto adicionado ao carrinho com sucesso!']);
    }

/**************************************************/
    public function getQtdCart()
    {
        $cart = Cart::where('user_id', auth()->id())->count();
        return response()->json($cart);
    }
}
