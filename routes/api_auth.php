<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {

    Route::post('register', [\App\Http\Controllers\API\Auth\RegisteredUserController::class, 'register']);
    Route::post('login', [\App\Http\Controllers\API\Auth\AuthenticatedController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [\App\Http\Controllers\API\Auth\AuthenticatedController::class, 'logout']);
    });
});
