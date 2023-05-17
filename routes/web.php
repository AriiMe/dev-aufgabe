<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveController;
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

Route::get('/', [LeaveController::class, 'home'])->name('home');

Route::post('/request', [LeaveController::class, 'request'])->name('request')->middleware('auth.check:1');
Route::post('/approve', [LeaveController::class, 'approve'])->name('approve')->middleware('auth.check:2');
Route::post('/deny', [LeaveController::class, 'deny'])->name('deny')->middleware('auth.check:2');
