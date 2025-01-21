<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Filament\Navigation\NavigationGroup;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Filament::registerNavigationGroups([
            NavigationGroup::make('Masalar ve Sipariş Yönetimi'),
            NavigationGroup::make('Kafe ve Menü İçerik Yönetimi'),
            NavigationGroup::make('İşletme İstatistikleri'),
        ]);
    }
}
