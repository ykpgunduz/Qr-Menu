<?php

namespace App\Filament\Resources\OrderResource\Pages;

use Filament\Actions;
use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Masaya Sipariş Ekle')
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('Hepsi')
                ->icon('heroicon-o-wallet'),
            'Yeni Sipariş' => Tab::make()
                ->icon('heroicon-o-sparkles')
                ->query(fn ($query) => $query->where('status', 'Yeni Sipariş')),
            'Hazırlanıyor' => Tab::make()
                ->icon('heroicon-o-clock')
                ->query(fn ($query) => $query->where('status', 'Hazırlanıyor')),
            'Teslim Edildi' => Tab::make()
                ->icon('heroicon-o-check-circle')
                ->query(fn ($query) => $query->where('status', 'Teslim Edildi'))
        ];
    }
}
