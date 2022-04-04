<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


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
    return view('welcome');
})->name('index');



Route::middleware('auth')->group(function () {
    Route::get('/auth/logout', [ \App\Http\Controllers\AuthController::class, 'logout' ])->name('logout');

    Route::get('/profile', [ \App\Http\Controllers\AuthController::class, 'profile' ])->name('profile');
});

Route::middleware('guest')->group(function () {
    Route::get('/auth/redirect', [ \App\Http\Controllers\AuthController::class, 'AuthRedirect'])->name('login');
    Route::get('/auth/callback', [ \App\Http\Controllers\AuthController::class, 'AuthCallback' ]);
});
