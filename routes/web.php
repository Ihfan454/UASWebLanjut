<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplaintController;
use App\Models\Complaint;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// DASHBOARD (ambil data dari DB)
Route::get('/dashboard', function () {
    $total   = Complaint::count();
    $pending = Complaint::where('status', 'baru')->count();     // baru = menunggu
    $process = Complaint::where('status', 'proses')->count();
    $resolved= Complaint::where('status', 'selesai')->count();

    $complaints = Complaint::latest()->take(10)->get(); // 10 laporan terbaru

    return view('dashboard', compact('total','pending','process','resolved','complaints'));
})->name('dashboard');

// CRUD Complaint
Route::resource('complaints', ComplaintController::class);

// (Kalau Breeze dipakai, biarin aja bagian ini)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

