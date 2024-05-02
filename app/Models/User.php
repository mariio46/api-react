<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    public function avatar(?int $size = 150): string
    {
        $hash = hash(algo: 'sha256', data: $this->email);

        return "https://www.gravatar.com/avatar/{$hash}?s={$size}&d=mp";
    }

    public function getLastUpdatedAccount(): string
    {
        return $this->last_updated_account ? "Last updated account {$this->last_updated_account->diffForHumans()}." : 'Account not updated yet!';
    }

    public function getLastUpdatedPassword(): string
    {
        return $this->last_updated_password ? "Last updated password {$this->last_updated_password->diffForHumans()}." : 'Password not updated yet!';
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
