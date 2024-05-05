<?php

use App\Helpers\ApiResponse;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('users', Controllers\User\UserController::class)
        ->missing(fn (Request $request) => ApiResponse::notFound(data: "Cannot find User with Username: {$request->user}"));
});

require __DIR__ . '/auth.php';
