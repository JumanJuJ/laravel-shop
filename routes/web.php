<?php

use Illuminate\Support\Facades\Route;
#views senza logica solo frontend
Route::view('/', 'home2')->name('home');
Route::view('/about-us', 'about-us')->name('about-us');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
