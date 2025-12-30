<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PriceResource extends JsonResource
{

    // protected $product;

    // public function __construct(Product $product){
    //     $this->product = $product;
    // }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => [
                'id' => $this->category->id ?? null,
                'name' => $this->category->name ?? null,
            ],
            'product_images_just_one' => [
                'path' => $this->productImagesJustOne->path ?? null,
            ],
            'price' => number_format($this->price, 2, ',', '.'), // só alteramos o price
            'from_price' => number_format($this->from_price, 2, ',', '.'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
