<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\AdminController;

Route::get('/routes', function() {
    dd(Route::getRoutes());
});


Route::get('/', [AuthController::class, 'login'])->name('login.post');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login.post');


Route::middleware(['auth'])->group(function () {
    Route::get('/home', [LeaveController::class, 'home'])->name('user.home');
    Route::get('/admin', [AdminController::class, 'home'])->name('admin.home');
    Route::post('/request', [LeaveController::class, 'request'])->name('request');
    Route::post('/approve', [LeaveController::class, 'approve'])->name('approve');
    Route::post('/deny', [LeaveController::class, 'deny'])->name('deny');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
