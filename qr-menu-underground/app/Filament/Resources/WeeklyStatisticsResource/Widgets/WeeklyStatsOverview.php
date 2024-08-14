<?php

namespace App\Filament\Resources\WeeklyStatisticsResource\Widgets;

use App\Models\PastOrder;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class WeeklyStatsOverview extends BaseWidget
{
    protected function getWeeklyCustomerCount(): int
    {
        return PastOrder::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->distinct('session_id')
            ->count('session_id');
    }

    protected function getWeeklyOrderCount(): int
    {
        return PastOrder::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();
    }

    protected function getWeeklyRevenue(): float
    {
        return PastOrder::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum(DB::raw('price * quantity'));
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Haftalık Gelen Müşteri Sayısı', $this->getWeeklyCustomerCount())
                ->color('success')
                ->chart([10, 15, 12, 20, 25, 18, 30])
                ->description('%7 geçen haftaya göre daha fazla')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),

            Stat::make('Haftalık Gelen Sipariş Sayısı', $this->getWeeklyOrderCount())
                ->color('warning')
                ->chart([9, 8, 10, 12, 14, 13, 16])
                ->description('%2 geçen haftaya göre daha düşük')
                ->descriptionIcon('heroicon-m-arrow-trending-down'),

            Stat::make('Haftalık Yapılan Ciro', number_format($this->getWeeklyRevenue(), 0, ',', '.') . ' ₺')
                ->color('danger')
                ->chart([10000, 15000, 12000, 20000, 25000, 18000, 30000])
                ->description('%5 geçen haftaya göre daha yüksek')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}
