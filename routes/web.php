<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Routes of Accounts
    Route::livewire('/accounts', 'pages::accounts.index')->name('accounts.index');
    Route::livewire('/accounts/create', 'pages::accounts.create')->name('accounts.create');
    Route::livewire('/accounts/{account}/edit', 'pages::accounts.edit')->name('accounts.edit');

    // Routes of Transactions
    Route::livewire('/transactions', 'pages::transactions.index')->name('transactions.index');
    Route::livewire('transactions/create', 'pages::transactions.create')->name('transactions.create');

    // Routes of Categories
    Route::livewire('/categories', 'pages::categories.index')->name('categories.index');
});

require __DIR__.'/settings.php';
