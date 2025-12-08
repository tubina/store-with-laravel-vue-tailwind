<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

use App\Repositories\Interfaces\CartInterface;
use App\Services\CartService;
 

class CartController extends Controller
{ 
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
/**************************************************/
    public function index() 
    {
        $cart = $this->cartService->index();
        return Inertia::render('Cart', ['cart' => $cart]);
    }  
/**************************************************/
    // public function index()
    // {
    //     $cart = Cart::where('user_id', auth()->id())->with('product.category')->with('product.productImagesJustOne')->get();

    //     return Inertia::render('Cart', ['cart' => $cart]);
    // } 
/**************************************************/
    public function addToCart(Request $request)
    {
        $userId = auth()->id();
        $items = $request->product_id; // array de product_id
  
        if (!is_array($items)) {
            $items = [$items];
        }  
        Log::info('usuario', $items);
        $result = $this->cartService->addItemsToCart($userId, $items);

        if (!$result['success']) {
            return response()->json(['message' => $result['message']], 500);
        }

        return response()->json(['message' => $result['message']], 200);
    }
/**************************************************/
    // public function addToCart(Request $request)
    // {
    //     $user = $request->user()->id;
    //     $product_id = $request->product_id;
    //     $items = $request->input('product_id');

    //     if(is_array($request->input('product_id')))
    //     {
    //         foreach($items as $item){
    //             $cartItem = Cart::where('user_id', $user)
    //                 ->where('product_id', $item)
    //                 ->first();
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
    // }
/**************************************************/
    public function getQtdCart()
    {
        $cart = Cart::where('user_id', auth()->id())->count();
        return response()->json($cart);
    }
/**************************************************/
    function deleteFromCart(Request $request)
    {
        $cart = Cart::where('product_id', $request->product_id)
                    ->where('user_id', auth()->id())
                    ->delete();
        Log::debug('Items deletados', ['count', $cart]);

        return response()->json(['success' => true]);
    }
}
