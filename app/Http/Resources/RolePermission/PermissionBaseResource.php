<?php

namespace App\Http\Resources\RolePermission;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionBaseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'guard' => $this->guard_name,
            'created' => $this->created_at,
            'updated' => $this->updated_at,
        ];
    }
}
