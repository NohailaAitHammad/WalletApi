<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\WalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');
Route::post('/user/register', [AuthController::class, 'register' ]);
Route::post('/user/login', [AuthController::class, 'login' ]);

Route::middleware('auth:sanctum')->group(function (){
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/user/logout', [AuthController::class, 'logout' ]);
    Route::apiResource('wallets', WalletController::class);
    Route::post('/wallets/{wallet}/deposit', [TransactionController::class, 'deposit']);
    Route::post('/wallets/{wallet}/withdraw', [TransactionController::class, 'withdraw']);
    Route::get('/wallets/{wallet}/transactions', [TransactionController::class, 'transactions']);
});


