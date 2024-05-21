<?php

namespace App\Http\Resources\Type;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TypeIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            $this->merge(new TypeBaseResource($this)),
            'products_count' => $this->products_count,
        ];
    }
}
