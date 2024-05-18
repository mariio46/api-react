<?php

namespace App\Http\Resources\RolePermission;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionShowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            $this->merge(new PermissionBaseResource($this)),
            'roles' => $this->roles->map(fn ($role) => [
                'id' => $role->id,
                'name' => $role->name,
                'guard' => $role->guard_name,
                'created' => $role->created_at,
                'updated' => $role->updated_at,
            ]),
        ];
    }
}
