<?php

namespace App\Filament\Widgets;

use App\Models\PastOrder;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class BoxStatsOverview extends BaseWidget
{
    protected function getDailyCustomerCount(): int
    {
        return PastOrder::whereDate('created_at', today())->distinct('session_id')->count('session_id');
    }

    protected function getDailyOrderCount(): int
    {
        return PastOrder::whereDate('created_at', today())->count();
    }

    protected function getDailyRevenue(): float
    {
        return PastOrder::whereDate('created_at', today())
            ->sum(DB::raw('price * quantity'));
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Günlük Gelen Müşteri Sayısı', $this->getDailyCustomerCount())

            ->color('success')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->description('%5 günlere göre daha fazla')
            ->descriptionIcon('heroicon-m-arrow-trending-up'),

            Stat::make('Günlük Gelen Sipariş Sayısı', $this->getDailyOrderCount())

            ->color('warning')
            ->chart([7, 2, 9, 3, 5, 4, 3])
            ->description('%1 günlere göre daha düşük')
            ->descriptionIcon('heroicon-m-arrow-trending-down'),

            // Ondalıklı ciro: Stat::make('Günlük Yapılan Ciro', number_format($this->getDailyRevenue(), 2, ',', '.') . ' ₺')

            Stat::make('Günlük Yapılan Ciro', number_format($this->getDailyRevenue(), 0, ',', '.') . ' ₺')

            ->color('danger')
            ->chart([17, 14, 15, 9, 10, 4, 1])
            ->description('%3 günlere göre daha yüksek')
            ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }

}
