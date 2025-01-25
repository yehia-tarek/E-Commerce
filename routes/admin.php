<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\CustomersController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Auth\AdminAuthController;

Route::middleware('guest:admin')->group(function () {
    Route::get('login', [AdminAuthController::class, 'create']);
    Route::post('login', [AdminAuthController::class, 'store'])->name('admin.login');
});

Route::middleware('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::put('profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('admin.profile.password.update');

    Route::post('logout', [AdminAuthController::class, 'destroy'])->name('admin.logout');

    Route::resource('admins', AdminController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('customers', CustomersController::class);
});
