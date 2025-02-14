<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Auth;

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');
    
    Route::post('/logout', function () {
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');
});

Route::get('/', Home::class)->name('home');

// Halaman produk
Route::get('/products', function () {
    return view('products');
})->name('products');

// Kategori produk
Route::get('/products/{category}', function ($category) {
    return view('category', ['category' => $category]);
})->name('category');

// Halaman tracking order
Route::get('/track-order', function () {
    return view('track_order');
})->name('track_order');

// Halaman dealers
Route::get('/dealers', function () {
    return view('dealers');
})->name('dealers');

// Halaman customer support
Route::get('/customer-support', function () {
    return view('support');
})->name('support');

// Halaman keranjang belanja
Route::get('/cart', function () {
    return view('cart');
})->name('cart');

// Halaman profil pengguna
Route::get('/profile', function () {
    return view('profile');
})->name('profile');