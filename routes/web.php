<?php

use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StorefrontController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\UserController;

// Public storefront — anyone can browse.
Route::get('/', [StorefrontController::class, 'home'])->name('home');
Route::get('/category/{categoryName}', [StorefrontController::class, 'category'])->name('category');
Route::get('/product/{slug}', [StorefrontController::class, 'show'])->name('product.show');
Route::get('/search', [StorefrontController::class, 'search'])->name('storefront.search');
Route::get('/category/{slug}', [StorefrontController::class, 'category'])->name('category');

// Guest-only auth screens.
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
// Buying requires an account — browsing does not.
Route::middleware('auth')->group(function () {
    Route::get('/bag', [CartController::class, 'index'])->name('cart.index');
    Route::post('/bag/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/bag/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/bag/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/product/{slug}', [StorefrontController::class, 'show'])->name('product.show');
});

// Admin area — full product CRUD, staff only.
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/products');
    Route::resource('products', AdminProductController::class)->except('show');
});
//Admin area-full category CRUD, staff only
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', CategoryController::class);
});
//Admin area-full User management, staff only
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', AdminUserController::class);
});
//user Profile
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [UserController::class, 'update'])->name('profile.update');
});
