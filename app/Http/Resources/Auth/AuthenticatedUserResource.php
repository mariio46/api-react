<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthenticatedUserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $role = $this->roles->first();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'avatar' => $this->avatar(),
            'last_updated_account' => $this->last_updated_account,
            'last_updated_password' => $this->last_updated_password,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'role' => [
                'id' => $role->id,
                'name' => $role->name,
                'permissions' => $role->id != 1 ? $role->getAllPermissions()->pluck('name') : ['*'],
            ],
        ];
    }
}
