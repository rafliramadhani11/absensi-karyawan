<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login')->middleware('CheckUser');
Route::post('/', [AuthController::class, 'authentication']);
Route::post('logout', [AuthController::class, 'destroy'])->name('logout')->middleware('auth');

Route::controller(UserController::class)->group(function () {
    Route::get('/dashboard-user', 'index')->name('user.index')->middleware('user');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/dashboard-admin', 'index')->name('admin.index')->middleware('admin');
});
