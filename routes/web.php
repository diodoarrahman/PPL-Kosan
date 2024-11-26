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

Route::get('/', [LandingPageController::class, 'index'])->name('landing');


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('/mainpage', [KosanController::class, 'index'])->name('mainpage');

// Pindahkan rute KosanController di luar middleware untuk sementara
// Kosan routes tanpa auth middleware
// Route::get('/kosan', [KosController::class, 'index'])->name('kosan.index');
// Route::get('/kosan/{id}', [KosController::class, 'show'])->name('kosan.show');
// Route::get('/kosan/create', [KosController::class, 'create'])->name('kosan.create');
// Route::post('/kosan', [KosController::class, 'store'])->name('kosan.store');
// Route::get('/kosann/manage/', [KosController::class, 'manage'])->name('kosan.manage');
// Route::get('/kosan/{id}/edit', [KosController::class, 'edit'])->name('kosan.edit');
// Route::put('/kosan/{id}', [KosController::class, 'update'])->name('kosan.update');
// Route::delete('/kosan/{id}', [KosController::class, 'destroy'])->name('kosan.destroy');
Route::get('/mainpage', [KosController::class, 'index'])->name('mainpage');
Route::get('/kosan', [KosController::class, 'index'])->name('kosan.index');
Route::get('/kosan/manage/', [KosController::class, 'manage'])->name('kosan.manage');
Route::get('/kosan/create', [KosController::class, 'create'])->name('kosan.create');
Route::post('/kosan', [KosController::class, 'store'])->name('kosan.store');
Route::get('/kosan/{id}', [KosController::class, 'show'])->name('kosan.show');
Route::get('/kosan/{id}/edit', [KosController::class, 'edit'])->name('kosan.edit');
Route::put('/kosan/{id}', [KosController::class, 'update'])->name('kosan.update');
Route::delete('/kosan/{id}', [KosController::class, 'destroy'])->name('kosan.destroy');
// Favorite routes
Route::get('/favorite', [FavoriteController::class, 'index'])->name('favorite.index');
Route::post('/favorite/add', [FavoriteController::class, 'store'])->name('favorite.store');
Route::delete('/favorite/{id}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');

// Transaction routes
Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
Route::post('/transaction/create', [TransactionController::class, 'store'])->name('transaction.store');
Route::post('/transaction/cancel/{id}', [TransactionController::class, 'cancel'])->name('transaction.cancel');

// Tambahkan di web.php
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');

// Tambahkan di web.php
Route::get('/admin/dashboard', function () {
    return view('dashboard.admin');
})->name('admin.dashboard');

Route::get('/owner/dashboard', [OwnerController::class, 'ownerDashboard'])->name('owner.dashboard');


// Tambahkan di web.php
Route::get('/user/manage', function () {
    return view('user.manage');
})->name('user.manage');

Route::get('/test-route', function () {
    return "This is a test route.";
});
// Route::get('/kosan/manage-test', [KosanController::class, 'manage']);

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::post('/transaction/{id}/pay', [TransactionController::class, 'pay'])->name('transaction.pay');