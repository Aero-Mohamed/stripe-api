<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', [\App\Http\Controllers\API\Auth\RegisteredUserController::class, 'register']);
});

Route::group([
    'as' => 'passport.',
    'prefix' => config('passport.path', 'oauth'),
], function () {

    Route::post('/token', [\App\Http\Controllers\API\Auth\AuthenticatedController::class, 'issueToken'])
        ->middleware('throttle')->name('token');

    Route::delete('/token', [\App\Http\Controllers\API\Auth\AuthenticatedController::class, 'logout'])
        ->middleware('auth:api')->name('tokens.destroy');

});
