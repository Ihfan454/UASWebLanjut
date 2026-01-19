<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

// ============================================
// PUBLIC ROUTES (Tanpa Login)
// ============================================

// Welcome Page (Homepage)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard Page (Public)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ============================================
// AUTH ROUTES (Login & Register)
// ============================================

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// ============================================
// PROTECTED ROUTES - Harus Login
// ============================================

Route::middleware(['auth'])->group(function () {
    
    // Profile Routes (yang sudah ada)
    Route::middleware('auth')->group(callback: function (): void {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    
    // ============================================
    // MAHASISWA ROUTES - Complaints
    // ============================================
    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::resource('complaints', ComplaintController::class);
    
    // ============================================
    // ADMIN ROUTES - Dashboard & Management
    // ============================================
    Route::middleware(['admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/complaints', [AdminController::class, 'complaints'])->name('admin.complaints');
        Route::patch('/complaints/{complaint}/status', [AdminController::class, 'updateStatus'])->name('admin.complaints.status');
    });
});

// Auth include (jika ada)
require __DIR__.'/auth.php';