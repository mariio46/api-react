<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserShowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            $this->merge(new UserBaseResource($this)),
            'avatar' => $this->avatar(size: 250),
            'last_updated_account' => $this->last_updated_account,
            'last_updated_password' => $this->last_updated_password,
            'updated' => $this->updated_at,
        ];
    }
}
