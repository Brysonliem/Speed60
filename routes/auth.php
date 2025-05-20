<?php

use App\Livewire\Actions\Logout;
use App\Livewire\Auth\Registration;
use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Auth;

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Registration::class)->name('register');
});

Route::get('logout', Logout::class)
    ->middleware('auth')
    ->name('logout');
