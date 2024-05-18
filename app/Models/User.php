<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'last_updated_password',
        'last_updated_account',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getRouteKeyName(): string
    {
        return 'username';
    }

    public function avatar(?int $size = 150): string
    {
        $hash = hash(algo: 'sha256', data: $this->email);

        return "https://www.gravatar.com/avatar/{$hash}?s={$size}&d=mp";
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_updated_password' => 'datetime',
            'last_updated_account' => 'datetime',
        ];
    }
}
