<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserShowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'avatar' => $this->avatar(size: 250),
            'verified' => $this->email_verified_at ? 'Verfied ' . $this->email_verified_at->diffForHumans() : 'Not verified',
            'last_updated_account' => $this->getLastUpdatedAccount(),
            'last_updated_password' => $this->getLastUpdatedPassword(),
            'joined' => $this->created_at->diffForHumans(),
            'updated' => $this->updated_at->diffForHumans(),
        ];
    }
}
