<?php

namespace App\Http\Resources\Type;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TypeShowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            $this->merge(new TypeBaseResource($this)),
            'products' => $this->products->map(fn ($product) => [
                'type' => $product->type,
                'category' => $product->category,
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
            ]),
        ];
    }
}
