<?php

use App\Livewire\Pages\Carts;
use App\Livewire\Pages\CheckoutFailed;
use App\Livewire\Pages\CheckoutProduct;
use App\Livewire\Pages\CheckoutSuccess;
use App\Livewire\Pages\IndexTransactions;
use App\Livewire\Pages\OurStore;
use App\Livewire\Pages\OurStory;
use App\Livewire\Pages\Policies\PrivacyPolicy;
use App\Livewire\Pages\Policies\RefundPolicy;
use App\Livewire\Pages\Policies\ShippingInformation;
use App\Livewire\Pages\Policies\TermsAndCondition;
use App\Livewire\Pages\Products\Create;
use App\Livewire\Pages\Products\Index;
use App\Livewire\Pages\ProductDetail;
use App\Livewire\Pages\Products\IndexAdmin;
use App\Livewire\Pages\Reviews;
use App\Livewire\Pages\Wholesale;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Admin;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Products\Edit;
use App\Livewire\Pages\Profile;
use App\Livewire\Pages\Refunds\Index as RefundsIndex;
use App\Livewire\Pages\Reviews\Create as ReviewsCreate;
use App\Livewire\Pages\Reviews\Index as ReviewsIndex;
use App\Livewire\Pages\Tabs\StoreReview;
use App\Livewire\Pages\UserDashboard;
use App\Livewire\Pages\Vouchers\Index as VoucherIndex;
use App\Livewire\Pages\Vouchers\Create as VoucherCreate;
use App\Livewire\Pages\Vouchers\Edit as VoucherEdit;

Route::prefix('/')->group(function () {
    Route::get('dashboard', UserDashboard::class)->name('dashboard.user');
});

Route::middleware(['auth', 'verified'])->name('dashboard.')->group(function () {
    Route::get('/dashboard-admin', Admin::class)->name('admin');
    Route::get('/dashboard-superadmin', Home::class)->name('superadmin');
});

Route::name('policies')->group(function() {
    Route::get('/term-and-conditions', TermsAndCondition::class)->name('.terms');
    Route::get('/privacy-policy', PrivacyPolicy::class)->name('.privacy');
    Route::get('/refund-policy', RefundPolicy::class)->name('.refund');
    Route::get('/shipping-policy', ShippingInformation::class)->name('.shipping');
});

Route::name('about')->group(function() {
    Route::get('/our-store', OurStore::class)->name('.our-store');
    Route::get('/our-story', OurStory::class)->name('.our-story');
    Route::get('/wholesale', Wholesale::class)->name('.wholesale');
    Route::get('/reviews', Reviews::class)->name('.reviews');
});

Route::middleware('auth')->group(function () {

    Route::prefix('products')->name('products.')->group(function () {
        Route::get('', Index::class)->name('index');
        Route::get('index-admin', IndexAdmin::class)->name('index.admin');
        Route::get('create', Create::class)->name('create');
        Route::get('{product}/edit', Edit::class)->name('edit');
        Route::get('{product}/detail', ProductDetail::class)->name('detail');
        Route::get('checkout', CheckoutProduct::class)->name('checkout');
        Route::get('checkout/success', CheckoutSuccess::class)->name('checkout.success');
        Route::get('checkout/failed', CheckoutFailed::class)->name('checkout.failed');
    });

    Route::prefix('vouchers')->name('vouchers.')->group(function () {
        Route::get('', VoucherIndex::class)->name('index');
        Route::get('create', VoucherCreate::class)->name('create');
        Route::get('{voucher}/edit', VoucherEdit::class)->name('edit');
    });

    Route::prefix('carts')->name('carts.')->group(function () {
        Route::get('', Carts::class)->name('index');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/{user}', Profile::class)->name('show');
    });

    Route::prefix('transactions')->name('transaction.')->group(function() {
        Route::get('', IndexTransactions::class)->name('index');
    });

    Route::prefix('refunds')->name('refunds.')->group(function() {
        Route::get('', RefundsIndex::class)->name('index');
    });

    Route::prefix('reviews')->name('reviews.')->group(function() {
        Route::get('index', ReviewsIndex::class)->name('index');
        Route::get('create', ReviewsCreate::class)->name('create');
        Route::get('{variant_id}/store/{detail_id}', StoreReview::class)->name('store');
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

// Route::get('/debug/rajaongkir/calculate', function (\App\Services\RajaOngkirClient $ro) {
//     $payload = [
//         'origin'          => (int) config('rajaongkir.origin_id'),   // dari .env
//         'destination'     => (int) config('rajaongkir.origin_id'), // tujuan: coba sendiri
//         'weight'          => 1000, // 1kg (gram)
//         'courier'         => config('rajaongkir.default_couriers'),
//         'price'           => 'lowest'
//     ];

//     $res = $ro->cost($payload);
//     return $res;
// });

// Route::get('/debug/rajaongkir/origin-ids', function (\App\Services\RajaOngkirClient $ro) {
//     // 1) Provinsi: Jawa Barat
//     $prov = collect(
//             data_get($ro->provinces(), 
//             'data',
//             [])
//         )
//             ->first(fn($p) => Str::upper($p['name']) === 'BANTEN');

//     // 2) Kota Bekasi (bukan Kab. Bekasi)
//     $city = collect(data_get($ro->cities($prov['id']), 'data', []))
//         ->first(fn($c) => Str::upper($c['name']) === 'TANGERANG');

//         // // 3) Daerah Mustikajaya
//     $dis = collect(data_get($ro->districts($city['id']), 'data', []))
//         ->first(function ($s) {
//             $name = Str::of($s['name'])->upper()->replace(' ', '');
//             return in_array($name, ['PANONGAN']); // redundant-safe
//         });
//     // 4) Kecamatan Mustikajaya
//     $sub = collect(data_get($ro->subdistricts($dis['id']), 'data', []))
//         ->first(function ($s) {
//             $name = Str::of($s['name'])->upper()->replace(' ', '');
//             return in_array($name, ['PANONGAN']); // redundant-safe
//         });

//     return [
//         'province' => $prov,
//         'city'     => $city,
//         'district' => $dis,
//         'subdistrict' => $sub,
//         'how_to_set_env' => [
//             'ORIGIN_SUBDISTRICT_ID' => $sub['subdistrict_id'] ?? null,
//             'ORIGIN_CITY_ID'        => $city['city_id'] ?? null,
//             'note' => 'Pakai ORIGIN_SUBDISTRICT_ID agar originType=subdistrict',
//         ],
//     ];
// });

require __DIR__ . '/auth.php';
