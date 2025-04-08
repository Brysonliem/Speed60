<?php

use App\Livewire\Pages\Carts;
use App\Livewire\Pages\CheckoutProduct;
use App\Livewire\Pages\CheckoutSuccess;
use App\Livewire\Pages\Products\Create;
use App\Livewire\Pages\Products\Index;
use App\Livewire\Pages\ProductDetail;
use App\Livewire\Pages\Products\IndexAdmin;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Admin;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Profile;
use App\Livewire\Pages\UserDashboard;

Route::middleware(['auth','verified'])->name('dashboard.')->group(function() {
    Route::get('/dashboard-admin', Admin::class)->name('admin');
    Route::get('/dashboard-superadmin', Home::class)->name('superadmin');
    Route::get('/dashboard', UserDashboard::class)->name('user');
});

Route::middleware('auth')->group(function() {
    
    Route::prefix('products')->name('products.')->group(function() {
        Route::get('', Index::class)->name('index');
        Route::get('index-admin', IndexAdmin::class)->name('index.admin');
        Route::get('create', Create::class)->name('create');
        Route::get('{product}/detail', ProductDetail::class)->name('detail');
        Route::get('checkout', CheckoutProduct::class)->name('checkout');
        Route::get('checkout/success', CheckoutSuccess::class)->name('checkout.success');
    });

    Route::prefix('carts')->name('carts.')->group(function() {
        Route::get('', Carts::class)->name('index');
    });

    Route::prefix('profile')->name('profile.')->group(function() {
        Route::get('/{user}', Profile::class)->name('show');
    });

});

// Halaman produk

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