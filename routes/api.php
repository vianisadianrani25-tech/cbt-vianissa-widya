<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MapelController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application.
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route API untuk Mapel
Route::prefix('mapel')->group(function () {
    Route::get('/', [MapelController::class, 'index']);
    Route::get('/{id}', [MapelController::class, 'show']);
    Route::post('/', [MapelController::class, 'store']);
    Route::put('/{id}', [MapelController::class, 'update']);
    Route::delete('/{id}', [MapelController::class, 'destroy']);
});