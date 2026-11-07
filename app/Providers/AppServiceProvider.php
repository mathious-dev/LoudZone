<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        Schema::defaultStringLength(191);
        if (str_starts_with(env('APP_URL'), 'https://')) {
        URL::forceScheme('https');
        URL::forceRootUrl(env('APP_URL')); // Cette ligne force l'URL du tunnel
    }
    
    }
}
