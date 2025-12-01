<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'Dealership API ready',
        'endpoints' => [
            'POST /api/auth/login',
            'GET|POST|PUT|DELETE /api/cars',
            'GET|POST /api/sales',
        ],
    ]);
});

Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('/cars', [CarController::class, 'index']);
Route::get('/cars/{car}', [CarController::class, 'show']);
Route::get('/sales', [SaleController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/cars', [CarController::class, 'store']);
    Route::put('/cars/{car}', [CarController::class, 'update']);
    Route::delete('/cars/{car}', [CarController::class, 'destroy']);

    Route::post('/sales', [SaleController::class, 'store']);
});
