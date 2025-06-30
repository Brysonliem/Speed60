<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::directive('idr', function ($amount) {
            return "<?= 'Rp. ' . number_format($amount, 0, ',', '.'); ?>";
        });

        view()->composer('*', function ($view) {
            if (Auth::check() && !Session::has('promo_shown')) {
                Session::put('promo_shown', true);
                Session::flash('show_promo_modal', true);
            }
        });
    }
}
