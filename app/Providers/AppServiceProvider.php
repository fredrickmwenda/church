<?php

namespace App\Providers;

use App\Mail\Transport\SymfonyMailTransport;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Mail::extend('symfony', function ($config) {
        //     return new SymfonyMailTransport(
        //         $config['host'],
        //         $config['port'],
        //         $config['encryption'] ?? null,
        //         $config['username'],
        //         $config['password']
        //     );
        // });
        Schema::defaultStringLength(191);
    }
}
