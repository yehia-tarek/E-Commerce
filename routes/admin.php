<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminsController;
use App\Http\Controllers\Backend\Auth\AdminAuthController;


Route::middleware('guest:admin')->group(function () {
    Route::get('login', [AdminAuthController::class, 'create']);
    Route::post('login', [AdminAuthController::class, 'store'])->name('admin.login');
});

Route::middleware('admin')->group(function () {
    Route::get('dashboard', function () {
        return view('backend.dashboard');
    })->name('admin.dashboard');

    Route::post('logout', [AdminAuthController::class, 'destroy'])->name('admin.logout');

    Route::resource('admins', AdminsController::class);
});

