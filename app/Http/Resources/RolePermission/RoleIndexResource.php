<?php

namespace App\Http\Resources\RolePermission;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            $this->merge(new RoleBaseResource($this)),
            'permissions_count' => $this->permissions_count ?? 0,
            'users_count' => $this->users->count(),
        ];
    }
}
