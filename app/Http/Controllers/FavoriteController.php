<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Product;
use Inertia\Inertia;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::with('products')
        ->where('user_id', auth()->id())
        ->get();
        return Inertia::render('Favorite', ['favorites' => $favorites]);
    }
/********************************************************************************/
    public function getQtdFavorite()
    {
        $favorite = Favorite::where('user_id', auth()->id())->count();

        return response()->json($favorite);
    }
/********************************************************************************/
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
                    $favorite = new Favorite();
                    $favorite->user_id = $user;
                    $favorite->product_id = $item;
                    $favorite->save();
                }
            }
            return response()->json(['data'=> $items]);

        }else{
            try{
                // verifica no banco se ja tem o ID
                $favoriteItem = Favorite::where('user_id', $user)
                        ->where('product_id', $product_id)
                        ->first();
                // se ja tem entao ele nao insere
                if($favoriteItem)
                {
                    return response()->json(['message'=> 'Produdo já existe nos favoritos']);
                }else {
                    $favorite = new Favorite();
                    $favorite->user_id = $user;
                    $favorite->product_id = $product_id;
                    $favorite->save();
                }
            }catch(\Exception $e){
                \Log::error($e); // Aqui você verá o erro no log
                return response()->json(['message' => 'Erro no servidor'], 500);
            }
        }

        return response()->json(['message' => 'Produto adicionado ao favorito com sucesso!']);
    }
}
