<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Favorite extends Model
{
    protected $table = 'favorites';
    protected $fillable = ['user_id', 'product_id'];


    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
