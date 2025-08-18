<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImages;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $table = 'products';
    protected $fillable = ['id', 'name', 'category_id', 'from_price', 'price', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productImagesJustOne()
    {
        return $this->hasOne(ProductImages::class)->orderBy('id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImages::class);
    }

}
