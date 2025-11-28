<?php

use App\Interfaces\Http\Controllers\Api\Auth\LoginUserController;
use App\Interfaces\Http\Controllers\Api\Auth\RegisterUserController;
use App\Interfaces\Http\Controllers\Api\Recipe\CreateRecipeController;
use App\Interfaces\Http\Controllers\Api\Recipe\EditRecipeController;
use App\Interfaces\Http\Controllers\Api\Recipe\DeleteRecipeController;
use App\Interfaces\Http\Controllers\Api\Recipe\ListRecipeController;
use App\Interfaces\Http\Controllers\Api\Recipe\PrintRecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});

Route::post('/auth/login', LoginUserController::class)->name('login');
Route::post('/auth/register', RegisterUserController::class)->name('register');


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/recipes', CreateRecipeController::class)->name('recipes.store');
    Route::get('/recipes', ListRecipeController::class)->name('recipes.index');
    Route::put('/recipes/{id}', EditRecipeController::class)->name('recipes.update');
    Route::delete('/recipes/{id}', DeleteRecipeController::class)->name('recipes.delete');
    Route::get('/recipes/{id}/print', PrintRecipeController::class)->name('recipes.print');
});


// Route::post('/auth/logout', LogoutUserController::class)->name('logout');