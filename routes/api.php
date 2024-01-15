<?php

use App\Http\Controllers\API\V1\CategoriaProdutoController;
use App\Http\Controllers\API\V1\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->as('api.v1.')->group(function () {

    Route::prefix('categoria-produtos')->as('categoria-produtos')->group(function () {
        Route::get('/', [CategoriaProdutoController::class, 'index'])->name('.index');
        Route::post('/', [CategoriaProdutoController::class, 'store'])->name('.store');
        Route::get('/{id}', [CategoriaProdutoController::class, 'show'])->name('.show');
        Route::put('/{id}', [CategoriaProdutoController::class, 'update'])->name('.update');
        Route::delete('/{id}', [CategoriaProdutoController::class, 'destroy'])->name('.destroy');
    });

    Route::prefix('produtos')->as('produtos')->group(function () {
        Route::get('/', [ProdutoController::class, 'index'])->name('.index');
        Route::post('/', [ProdutoController::class, 'store'])->name('.store');
        Route::get('/{id}', [ProdutoController::class, 'show'])->name('.show');
        Route::put('/{id}', [ProdutoController::class, 'update'])->name('.update');
        Route::delete('/{id}', [ProdutoController::class, 'destroy'])->name('.destroy');
    });
});
