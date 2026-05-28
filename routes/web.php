<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home2')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
