<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::resource(name: 'articles', controller: Controllers\ArticleController::class);

Route::middleware(['auth:sanctum'])->group(function () {
    //
});

require __DIR__ . '/auth.php';
