<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\ManagerController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth']], function () {
    // User routes
});

// Routes for login views
Route::view('/admin/login', 'admin.login')->name('admin.login');
Route::view('/manager/login', 'manager.login')->name('manager.login');

// Routes for handling login submissions
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/manager/login', [ManagerController::class, 'login'])->name('manager.login.submit');

Route::group(['middleware' => ['auth:admin']], function () {
    // Admin routes
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/home', [AdminController::class, 'home'])->name('admin.home');
    Route::get('/admin/product/add', [ProductController::class, 'add'])->name('admin.productAdd');
    Route::post('/admin/product/submit', [ProductController::class, 'submit'])->name('admin.productSubmit');
    Route::get('/admin/product/edit/{id}', [ProductController::class, 'edit'])->name('admin.productEdit');
    Route::get('/admin/product/update', [ProductController::class, 'update'])->name('admin.productUpdate');
    Route::get('/admin/product/view', [ProductController::class, 'view'])->name('admin.productView');
});

Route::group(['middleware' => ['auth:manager']], function () {
    // Manager routes
    Route::get('/manager/dashboard', [ManagerController::class, 'index'])->name('manager.dashboard');
});

require __DIR__.'/auth.php';
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
