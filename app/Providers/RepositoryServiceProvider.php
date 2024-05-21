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

        // Role
        $this->app->bind(
            abstract: Repositories\Interfaces\RoleRepositoryInterface::class,
            concrete: Repositories\Repository\RoleRepository::class
        );

        // Permission
        $this->app->bind(
            abstract: Repositories\Interfaces\PermissionRepositoryInterface::class,
            concrete: Repositories\Repository\PermissionRepository::class
        );

        // Assignment
        $this->app->bind(
            abstract: Repositories\Interfaces\AssignmentRepositoryInterface::class,
            concrete: Repositories\Repository\AssignmentRepository::class
        );

        // Category
        $this->app->bind(
            abstract: Repositories\Interfaces\CategoryRepositoryInterface::class,
            concrete: Repositories\Repository\CategoryRepository::class
        );

        // Type
        $this->app->bind(
            abstract: Repositories\Interfaces\TypeRepositoryInterface::class,
            concrete: Repositories\Repository\TypeRepository::class
        );

        // Product
        $this->app->bind(
            abstract: Repositories\Interfaces\ProductRepositoryInterface::class,
            concrete: Repositories\Repository\ProductRepository::class
        );
    }

    public function boot(): void
    {
        //
    }
}
