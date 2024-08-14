<?php
namespace App\Filament\Resources\AnnualStatisticsResource\Widgets;

use App\Models\PastOrder;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class AnnualStatsOverview extends BaseWidget
{
    protected function getAnnualCustomerCount(): int
    {
        return PastOrder::whereYear('created_at', now()->year)
            ->distinct('session_id')
            ->count('session_id');
    }

    protected function getAnnualOrderCount(): int
    {
        return PastOrder::whereYear('created_at', now()->year)
            ->count();
    }

    protected function getAnnualRevenue(): float
    {
        return PastOrder::whereYear('created_at', now()->year)
            ->sum(DB::raw('price * quantity'));
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Yıllık Gelen Müşteri Sayısı', $this->getAnnualCustomerCount())
                ->color('success')
                ->chart([70, 20, 100, 30, 150, 40, 170])
                ->description('%5 geçen yıla göre daha fazla')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),

            Stat::make('Yıllık Gelen Sipariş Sayısı', $this->getAnnualOrderCount())
                ->color('warning')
                ->chart([70, 20, 90, 30, 50, 40, 30])
                ->description('%1 geçen yıla göre daha düşük')
                ->descriptionIcon('heroicon-m-arrow-trending-down'),

            Stat::make('Yıllık Yapılan Ciro', number_format($this->getAnnualRevenue(), 0, ',', '.') . ' ₺')
                ->color('danger')
                ->chart([170, 140, 150, 90, 100, 40, 10])
                ->description('%3 geçen yıla göre daha yüksek')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}
