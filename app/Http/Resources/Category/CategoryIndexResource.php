<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            $this->merge(new CategoryBaseResource($this)),
            'products_count' => $this->products_count,
        ];
    }
}
