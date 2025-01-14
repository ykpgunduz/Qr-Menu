<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // if ($this->app->environment('production')) {
        //     URL::forceScheme('https');
        // } elseif ($this->app->environment('local')) {
        //     logger('Yerel geliştirme ortamı algılandı.');
        // } else {
        //     abort(500, 'Bilinmeyen ortam algılandı. Lütfen geliştirici ile iletişime geçin.');
        // }
    }
}
