<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            $this->merge(new UserBaseResource($this)),
            'avatar' => $this->avatar(),
        ];
    }
}
