<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
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

Route::get('/admin', [AdminController::class, 'show'])->name('admin');


Route::get('/products', function () {
    return view('products');
});
