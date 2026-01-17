<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplaintController;

Route::get('/', [ComplaintController::class, 'index'])->name('complaints.index');
Route::resource('complaints', ComplaintController::class);