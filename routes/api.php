<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('server-status', Controllers\ApplicationStatusController::class);

Route::middleware(['auth:sanctum', 'permission:management admin|management member'])->group(function () {
    Route::get('users', [Controllers\User\UserController::class, 'index']);
    Route::post('users/store', [Controllers\User\UserController::class, 'store']);
    Route::get('users/{user}', [Controllers\User\UserController::class, 'show']);
    Route::put('users/{user}/update', [Controllers\User\UserController::class, 'update']);
    Route::delete('users/{user}/delete', [Controllers\User\UserController::class, 'delete']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('permissions-check', Controllers\RolePermission\CheckPermissionController::class);
});

Route::middleware(['auth:sanctum', 'permission:management role permission'])->group(function () {
    Route::get('roles', [Controllers\RolePermission\RoleController::class, 'index']);
    Route::post('roles/store', [Controllers\RolePermission\RoleController::class, 'store']);
    Route::get('roles/{role}', [Controllers\RolePermission\RoleController::class, 'show']);
    Route::put('roles/{role}/update', [Controllers\RolePermission\RoleController::class, 'update']);
    Route::delete('roles/{role}/delete', [Controllers\RolePermission\RoleController::class, 'delete']);

    Route::get('permissions', [Controllers\RolePermission\PermissionController::class, 'index']);
    Route::post('permissions/store', [Controllers\RolePermission\PermissionController::class, 'store']);
    Route::get('permissions/{permission}', [Controllers\RolePermission\PermissionController::class, 'show']);
    Route::put('permissions/{permission}/update', [Controllers\RolePermission\PermissionController::class, 'update']);
    Route::delete('permissions/{permission}/delete', [Controllers\RolePermission\PermissionController::class, 'delete']);
});

Route::middleware(['auth:sanctum', 'permission:management products'])->group(function () {
    Route::get('products', [Controllers\Product\ProductController::class, 'index']);
    Route::post('products/store', [Controllers\Product\ProductController::class, 'store']);
    Route::get('products/{product:id}', [Controllers\Product\ProductController::class, 'show']);
    Route::put('products/{product:id}/update', [Controllers\Product\ProductController::class, 'update']);
    Route::delete('products/{product:id}/delete', [Controllers\Product\ProductController::class, 'delete']);
});

Route::middleware(['auth:sanctum', 'permission:management categories'])->group(function () {
    Route::get('categories', [Controllers\Category\CategoryController::class, 'index']);
    Route::post('categories/store', [Controllers\Category\CategoryController::class, 'store']);
    Route::get('categories/{category:id}', [Controllers\Category\CategoryController::class, 'show']);
    Route::put('categories/{category:id}/update', [Controllers\Category\CategoryController::class, 'update']);
    Route::delete('categories/{category:id}/delete', [Controllers\Category\CategoryController::class, 'delete']);
});

Route::middleware(['auth:sanctum', 'permission:management types'])->group(function () {
    Route::get('types', [Controllers\Type\TypeController::class, 'index']);
    Route::post('types/store', [Controllers\Type\TypeController::class, 'store']);
    Route::get('types/{type:id}', [Controllers\Type\TypeController::class, 'show']);
    Route::put('types/{type:id}/update', [Controllers\Type\TypeController::class, 'update']);
    Route::delete('types/{type:id}/delete', [Controllers\Type\TypeController::class, 'delete']);
});

require __DIR__ . '/auth.php';
