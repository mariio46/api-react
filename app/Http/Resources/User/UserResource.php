<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'avatar' => $this->avatar(),
            'verified' => $this->email_verified_at ? 'Verfied ' . $this->email_verified_at->diffForHumans() : 'Not verified',
            'joined' => 'Joined ' . $this->created_at->diffForHumans(),
        ];
    }
}
