<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified',"role_manager:user"])->name('dashboard');

// admin
Route::middleware(['auth', 'verified',"role_manager:admin"])->group(function () {
    Route::prefix('admin')->group(function () {
       Route::controller(AdminController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('admin.dashboard');
        });

        Route::controller(CategoryController::class)->group(function () {
            Route::get('/categories', 'categories')->name('admin.categories');
            Route::get('/categories/create', 'create_category')->name('admin.create.category');
            Route::post('/categories/save', 'store_category')->name('admin.save.category');
            Route::get('/categories/edit/{id}', 'edit_category')->name('admin.edit.category');
            Route::post('/categories/update-category', 'update_category')->name('admin.update.category');
            Route::get('/category/delete/{id}', 'delete_category')->name('admin.delete.category');
        });
    });
});



Route::get('/vendor/dashboard', function () {
    return view('vendor');
})->middleware(['auth', 'verified',"role_manager:vendor"])->name('vendor.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
