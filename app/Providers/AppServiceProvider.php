<?php

namespace App\Providers;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
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
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }

        // View::composer('*', function ($view) {
        //     $view->with('errors', session()->get('errors', new MessageBag()));
        // });
    }
}
