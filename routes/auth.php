<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::post('register', Controllers\Auth\RegisterController::class);

Route::post('login', Controllers\Auth\LoginController::class);

Route::post('logout', Controllers\Auth\LogoutController::class)->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('user', Controllers\Auth\AuthenticatedUserController::class);

    Route::post('account', Controllers\Auth\UpdateAccountController::class);

    Route::post('security', Controllers\Auth\UpdatePasswordController::class);

    Route::post('delete-account', Controllers\Auth\DeleteAccountController::class);
});
