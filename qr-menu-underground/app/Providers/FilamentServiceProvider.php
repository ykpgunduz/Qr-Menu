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
            NavigationGroup::make('Masalar ve Siparişler'),
            NavigationGroup::make('İçerik ve Kullanıcı Yönetimi'),
            NavigationGroup::make('İşletme İstatistikleri'),
        ]);
    }
}
