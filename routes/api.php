<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\V1\ApiProductController;
use \App\Http\Controllers\Api\V1\ApiBrandController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['api.check.auth']],  function () {
    Route::get('/v1/products', [ApiProductController::class, 'index'])->name('api.v1.products');;
    Route::get('/v1/brands', [ApiBrandController::class, 'index'])->name('api.v1.brands');
});
