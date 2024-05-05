<?php

namespace App\Providers;

use App\Repositories;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Auth
        $this->app->bind(
            abstract: Repositories\Interfaces\AuthRepositoryInterface::class,
            concrete: Repositories\Repository\AuthRepository::class
        );

        // User
        $this->app->bind(
            abstract: Repositories\Interfaces\UserRepositoryInterface::class,
            concrete: Repositories\Repository\UserRepository::class
        );
    }

    public function boot(): void
    {
        //
    }
}
