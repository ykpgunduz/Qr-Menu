<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // if($this->app->environment('production')) {
        //     \URL::forceScheme('https');
        // } else {
        //     dd("Geliştirici ile irtibata geçiniz..");
        // }
    }
}
