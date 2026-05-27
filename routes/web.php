<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Routes of Accounts
    Route::livewire('/accounts', 'pages::accounts.index')->name('accounts.index');
    Route::livewire('/accounts/create', 'pages::accounts.create')->name('accounts.create');
});

require __DIR__.'/settings.php';
