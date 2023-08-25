<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('home');;

Route::group(['middleware' => ['check.auth']],  function () {
    Route::get('/sign-up', [AuthController::class, 'registerForm'])->name('register.form');
    Route::post('/sign-up', [AuthController::class, 'registerSave'])->name('register.save');
    Route::get('/sign-in', [AuthController::class, 'loginForm'])->name('login.form');
    Route::post('/sign-in', [AuthController::class, 'loginSave'])->name('login.save');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::get('/admin', [AdminController::class, 'productFormShow'])->name('product.form.show');
Route::post('/admin', [AdminController::class, 'productFormSave'])->name('product.form.save');

Route::get('/products', [ProductController::class, 'show'])->name('products');
