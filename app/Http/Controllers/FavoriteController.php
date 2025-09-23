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
        Favorite::create([
            'user_id' => $request->user()->id,
            'product_id' => 3
            // 'user_id' => $request->user()->id,
            // 'product_id' => $request->product_id
        ]);
    }
}
