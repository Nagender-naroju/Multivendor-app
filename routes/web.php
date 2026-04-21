<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified',"RoleManager:user"])->name('dashboard');


Route::get('/admin/dashboard', function () {
    return view('admin');
})->middleware(['auth', 'verified',"RoleManager:admin"])->name('admin.dashboard');


Route::get('/vendor/dashboard', function () {
    return view('vendor');
})->middleware(['auth', 'verified', "RoleManager:vendor"])->name('vendor.dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
