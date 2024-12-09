<?php

use App\Http\Controllers\OwnerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KosanController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\KosController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\UserController;

// Landing page
Route::get('/', [LandingPageController::class, 'index'])->name('landing');

// Auth routes (Register & Login)
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Mainpage route (No middleware)
Route::get('/mainpage', [KosController::class, 'index'])->name('mainpage');

// Kosan routes (Require Auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/kosan', [KosController::class, 'index'])->name('kosan.index');
    Route::get('/kosan/manage', [KosController::class, 'manage'])->name('kosan.manage');
    Route::get('/kosan/create', [KosController::class, 'create'])->name('kosan.create');
    Route::post('/kosan', [KosController::class, 'store'])->name('kosan.store');
    Route::get('/kosan/{id}', [KosController::class, 'show'])->name('kosan.show');
    Route::get('/kosan/{id}/edit', [KosController::class, 'edit'])->name('kosan.edit');
    Route::put('/kosan/{id}', [KosController::class, 'update'])->name('kosan.update');
    Route::delete('/kosan/{id}', [KosController::class, 'destroy'])->name('kosan.destroy');
});

// Favorite routes (Require Auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/favorite', [FavoriteController::class, 'index'])->name('favorite.index');
    Route::post('/favorite/add', [FavoriteController::class, 'store'])->name('favorite.store');
    Route::delete('/favorite/{id}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');
});

// Transaction routes (Require Auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::post('/transaction/create', [TransactionController::class, 'store'])->name('transaction.store');
    Route::post('/transaction/cancel/{id}', [TransactionController::class, 'cancel'])->name('transaction.cancel');
    Route::post('/transaction/{id}/pay', [TransactionController::class, 'pay'])->name('transaction.pay');
});

// Profile routes (Require Auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
});

// Admin & Owner Dashboard routes (Require Role)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [OwnerController::class, 'adminDashboard'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/owner/dashboard', [OwnerController::class, 'ownerDashboard'])->name('owner.dashboard');
});

// User management routes (Require Admin role)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/manage', [UserController::class, 'index'])->name('user.manage');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user', [UserController::class, 'store'])->name('user.store');
    Route::get('user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});

// Comment routes (No middleware required)
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

// Test route (No middleware required)
Route::get('/test-route', function () {
    return "This is a test route.";
});
