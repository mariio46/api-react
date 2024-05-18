<?php

namespace App\Http\Resources\RolePermission;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleShowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            $this->merge(new RoleBaseResource($this)),
            'users' => $this->users->map(fn ($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'created' => $user->created_at,
                'updated' => $user->updated_at,
            ]),
            'permissions' => $this->permissions->map(fn ($permission) => [
                'id' => $permission->id,
                'name' => $permission->name,
                'guard' => $permission->guard_name,
                'created' => $permission->created_at,
                'updated' => $permission->updated_at,
            ]),
        ];
    }
}
