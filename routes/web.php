<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->middleware('auth');


Route::prefix('/login')->group(function() {
    Route::get('/', [LoginController::class,'index'])->name('login');
    Route::post('/', [LoginController::class,'processLogin'])->name('login');
    Route::get('/logout', [LoginController::class,'processLogout'])->name('logout');
});

Route::prefix('/sign-in')->group(function() {
    Route::get('/', [RegisterController::class,'signIn'])->name('sign-in');
    Route::post('/register', [RegisterController::class,'register'])->name('register');
});

Route::namespace('User')->middleware(['auth','otorisasi'])->group(function() {

});
