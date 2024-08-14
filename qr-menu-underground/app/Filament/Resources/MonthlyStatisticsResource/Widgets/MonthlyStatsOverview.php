<?php

namespace App\Filament\Resources\MonthlyStatisticsResource\Widgets;

use App\Models\PastOrder;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class MonthlyStatsOverview extends BaseWidget
{
    protected function getMonthlyCustomerCount(): int
    {
        return PastOrder::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->distinct('session_id')
            ->count('session_id');
    }

    protected function getMonthlyOrderCount(): int
    {
        return PastOrder::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
    }

    protected function getMonthlyRevenue(): float
    {
        return PastOrder::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum(DB::raw('price * quantity'));
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Aylık Gelen Müşteri Sayısı', $this->getMonthlyCustomerCount())
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->description('%5 günlere göre daha fazla')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),

            Stat::make('Aylık Gelen Sipariş Sayısı', $this->getMonthlyOrderCount())
                ->color('warning')
                ->chart([7, 2, 9, 3, 5, 4, 3])
                ->description('%1 günlere göre daha düşük')
                ->descriptionIcon('heroicon-m-arrow-trending-down'),

            Stat::make('Aylık Yapılan Ciro', number_format($this->getMonthlyRevenue(), 0, ',', '.') . ' ₺')
                ->color('danger')
                ->chart([17, 14, 15, 9, 10, 4, 1])
                ->description('%3 günlere göre daha yüksek')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}
