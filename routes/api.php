<?php

use App\Http\Controllers\API\V1\CategoriaProdutoController;
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

Route::prefix('v1')->group(function () {
//    Route::apiResource('categoria-produtos', CategoriaProdutoController::class)->parameters(['categoria_produto' => 'id']);
    Route::prefix('categoria-produtos')->as('categoria-produtos')->group(function () {
        Route::get('/', [CategoriaProdutoController::class, 'index'])->name('.index');
        Route::post('/', [CategoriaProdutoController::class, 'store'])->name('.store');
        Route::get('/{id}', [CategoriaProdutoController::class, 'show'])->name('.show');
        Route::put('/{id}', [CategoriaProdutoController::class, 'update'])->name('.update');
        Route::delete('/{id}', [CategoriaProdutoController::class, 'destroy'])->name('.destroy');
    });
});
