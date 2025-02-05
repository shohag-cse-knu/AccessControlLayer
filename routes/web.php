<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Route;

// Default redirect to login for logged-out users
Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth','can:has_menu_access'])->group(function () {
    Route::get('/', [DashboardController::Class, 'index'])->name('dashboard');
    
    Route::resource('user', UserController::Class);
    Route::resource('menu', MenuController::Class);
    Route::resource('role', RoleController::class);

    Route::any('summary',[ReportController::Class, 'summary'])->name('summary');
    Route::any('case',[ReportController::Class, 'case'])->name('case');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
