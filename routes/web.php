<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;

Route::get('/',[AdminController::class,'home']);
Route::get('/home',[AdminController::class,'index'])->name('home');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});