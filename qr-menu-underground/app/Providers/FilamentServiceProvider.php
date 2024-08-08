<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Filament\Navigation\NavigationGroup;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Filament::registerNavigationGroups([
            NavigationGroup::make('Siparişler ve Masalar'),
            NavigationGroup::make('İçerik Yönetimi'),
            NavigationGroup::make('Geliştirici Yönetimi'),
        ]);
    }
}
