<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplaintController;

Route::get('/', function () {
    return redirect()->route('complaints.index');
});

Route::resource('complaints', ComplaintController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
});
