<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserBaseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $role = $this->roles->first();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'verified' => $this->email_verified_at,
            'joined' => $this->created_at,
            'role' => [
                'id' => $role->id,
                'name' => $role->name,
            ],
        ];
    }
}
