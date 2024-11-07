<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\UserController;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [UserController::class, 'index']);

    Route::prefix('/pessoa')->group(function () {
        Route::post('/', [PessoaController::class, 'store']);
        Route::get('/', [PessoaController::class, 'index']);
        Route::get('/{pessoa}', [PessoaController::class, 'show']);
        Route::put('/{pessoa}', [PessoaController::class, 'update']);
        Route::delete('/{pessoa}', [PessoaController::class, 'destroy']);
    });
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

