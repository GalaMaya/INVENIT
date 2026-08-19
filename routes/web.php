<?php

use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified'])->group(function () { 
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::view('profile', 'profile')->name('profile');
});



require __DIR__.'/auth.php';
