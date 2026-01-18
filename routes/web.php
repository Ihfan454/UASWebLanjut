<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplaintController;

Route::get('/', function () {
    return redirect()->route('complaints.index');
});

Route::resource('complaints', ComplaintController::class);

use App\Models\Complaint;

Route::get('/dashboard', function () {
    $total = Complaint::count();
    $pending = Complaint::where('status', 'baru')->count();
    $process = Complaint::where('status', 'proses')->count();
    $resolved = Complaint::where('status', 'selesai')->count();

    $complaints = Complaint::latest()->take(10)->get();

    return view('dashboard', compact('total', 'pending', 'process', 'resolved', 'complaints'));
})->name('dashboard');

