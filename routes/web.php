<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplaintController;
use App\Models\Complaint;

Route::get('/', function () {
    return redirect()->route('complaints.index');
});

Route::resource('complaints', ComplaintController::class);

Route::get('/dashboard', function () {
    $total = Complaint::count();
    $baru = Complaint::where('status', 'baru')->count();
    $proses = Complaint::where('status', 'proses')->count();
    $selesai = Complaint::where('status', 'selesai')->count();

    $recentComplaints = Complaint::latest()->take(5)->get();

    return view('dashboard', compact('total', 'baru', 'proses', 'selesai', 'recentComplaints'));
})->name('dashboard');

