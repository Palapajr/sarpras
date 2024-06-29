<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

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


// auth
Route::get('/login', [LoginController::class, 'index',])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses',])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout',])->name('logout');

//Middleware biar tidak bisa back ketika user sudah logout
Route::group(['middleware' => ['auth']], function () {
    // Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {
    //dashboard
    Route::get('/', [HomeController::class, 'dashboard',])->name('dashboard');

    //data user
    Route::get('/user', [HomeController::class, 'index'])->name('index');
    Route::get('/create', [HomeController::class, 'create'])->name('user.create');
    Route::post('/store', [HomeController::class, 'store'])->name('user.store');

    Route::get('/edit{id}', [HomeController::class, 'edit'])->name('user.edit');
    Route::put('/update{id}', [HomeController::class, 'update'])->name('user.update');

    Route::delete('/delete{id}', [HomeController::class, 'delete'])->name('user.delete');
});
