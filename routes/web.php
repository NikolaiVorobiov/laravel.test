<?php

use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');;

Route::group(['middleware' => ['check.auth']],  function () {
    Route::get('/sign-up', [AuthController::class, 'registerForm'])->name('register.form');
    Route::post('/sign-up', [AuthController::class, 'registerSave'])->name('register.save');
    Route::get('/sign-in', [AuthController::class, 'loginForm'])->name('login.form');
    Route::post('/sign-in', [AuthController::class, 'loginSave'])->name('login.save');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);


Route::group(['prefix' => '/admin'], function () {

    Route::get('/', function () {
        return view('admin.admin');
    });
    Route::get('/brands',  [BrandController::class, 'index'])->name('admin.brands.index');

    Route::group(['prefix' => '/products'], function () {
        Route::get('/', [AdminProductController::class, 'index'])->name('admin.products.index');

        Route::get('/create', [AdminProductController::class, 'create'])->name('admin.products.create');
        Route::post('/', [AdminProductController::class, 'store'])->name('admin.products.store');

        Route::get('/{productId}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/{productId}', [AdminProductController::class, 'update'])->name('admin.products.update');

        Route::get('/{productId}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
    });
});

