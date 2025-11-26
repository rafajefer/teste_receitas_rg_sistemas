<?php

use App\Interfaces\Http\Controllers\Api\Auth\LoginUserController;
use App\Interfaces\Http\Controllers\Api\Auth\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});

Route::post('/auth/login', LoginUserController::class);
Route::post('/auth/register', RegisterUserController::class);