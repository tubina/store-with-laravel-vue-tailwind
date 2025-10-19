<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function getQtdFavorite()
    {
        $favorite = Favorite::where('user_id', auth()->id())->count();

        return response()->json($favorite);
    }

    public function addToFavorite(Request $request)
    {
        $user = $request->user()->id;
        $product_id = $request->product_id;
        $items = $request->input('product_id');

        if(is_array($request->input('product_id')))
        {
            foreach($items as $item){
                $favoriteItem = Favorite::where('user_id', $user)
                    ->where('product_id', $item)
                    ->first();
                if($favoriteItem){
                    $favoriteItem->quantity = $favoriteItem->quantity + 1;
                    $carItem->save();
                }else{
                    $cart = new Favorite();
                    $cart->user_id = $user;
                    $cart->product_id = $item;
                    $cart->save();
                }
            }
            return response()->json(['data'=> $items]);

        }else{
            try{
            $favoriteItem = Favorite::where('user_id', $user)
                    ->where('product_id', $product_id)
                    ->first();
            if($favoriteItem)
            {
                $favoriteItem->quantity = $favoriteItem->quantity + 1;
                $favoriteItem->save();
            }else {
                $cart = new Favorite();
                $cart->user_id = $user;
                $cart->product_id = $product_id;
                $cart->save();
            }
            }catch(\Exception $e){
                \Log::error($e); // Aqui você verá o erro no log
                return response()->json(['message' => 'Erro no servidor'], 500);
            }
        }

        return response()->json(['message' => 'Produto adicionado ao favorito com sucesso!']);
    }
}
