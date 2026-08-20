<?php

use App\Livewire\Dashboard;

// view
use App\Livewire\Assets\Index as AssetsIndex;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified'])->group(function () { 
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::view('profile', 'profile')->name('profile');

    // assets
    Route::get('/assets', AssetsIndex::class)->name('assets');
});



require __DIR__.'/auth.php';
