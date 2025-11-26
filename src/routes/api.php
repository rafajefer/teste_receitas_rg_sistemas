<?php

use App\Interfaces\Http\Controllers\Api\Auth\LoginUserController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});

Route::post('/login', LoginUserController::class);