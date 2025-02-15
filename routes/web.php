<?php

use App\Livewire\Admin;
use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Auth;

Route::get('/admin', Admin::class)
    ->middleware('auth','verified')
    ->name('home');

Route::get('/superadmin', Home::class)
    ->middleware('auth','verified')
    ->name('home.superadmin');

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

require __DIR__.'/auth.php';