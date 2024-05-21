<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryShowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            $this->merge(new CategoryBaseResource($this)),
            'products' => $this->products->map(fn ($product) => [
                'category_id' => $product->category_id,
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
            ]),
        ];
    }
}
