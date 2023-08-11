<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\SignUpController;
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
});

Route::get('/sign-up', [SignUpController::class, 'form'])->name('sign-up');

Route::get('/sign-in', [SignInController::class, 'entrance'])->name('sign-in');

Route::get('/admin', [AdminController::class, 'show'])->name('admin');

Route::get('/logout', [LogoutController::class, 'exit1'])->name('logout');

Route::get('/products', function () {
    return view('products');
});
