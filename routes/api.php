<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {


    Route::prefix('stripe')->middleware('auth:sanctum')->group(function () {
        Route::post('update', \App\Http\Controllers\API\Stripe\UpdatePaymentMethodController::class);
    });

    require __DIR__ . '/api_auth.php';
});
