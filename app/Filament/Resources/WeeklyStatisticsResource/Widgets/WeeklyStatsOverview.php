<?php

namespace App\Filament\Resources\WeeklyStatisticsResource\Widgets;

use App\Models\PastOrder;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Carbon\Carbon;

class WeeklyStatsOverview extends BaseWidget
{
    protected function getWeeklyCustomerCount(): int
    {
        // Bu hafta için müşteri sayısını döndürür
        return PastOrder::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('customer');
    }

    protected function getLastWeekCustomerCount(): int
    {
        // Geçen hafta için müşteri sayısını döndürür
        return PastOrder::whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])->sum('customer');
    }

    protected function getWeeklyOrderCount(): int
    {
        // Bu hafta için sipariş sayısını döndürür
        return PastOrder::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
    }

    protected function getLastWeekOrderCount(): int
    {
        // Geçen hafta için sipariş sayısını döndürür
        return PastOrder::whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])->count();
    }

    protected function getWeeklyRevenue(): float
    {
        // Bu hafta için ciroyu döndürür
        return PastOrder::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('total_amount');
    }

    protected function getLastWeekRevenue(): float
    {
        // Geçen hafta için ciroyu döndürür
        return PastOrder::whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])->sum('total_amount');
    }

    protected function getStats(): array
    {
        $weeklyCustomerCount = $this->getWeeklyCustomerCount();
        $lastWeekCustomerCount = $this->getLastWeekCustomerCount();
        $customerChange = $this->getPercentageChange($lastWeekCustomerCount, $weeklyCustomerCount);
        $customerColor = $this->getStatColor($customerChange);

        $weeklyOrderCount = $this->getWeeklyOrderCount();
        $lastWeekOrderCount = $this->getLastWeekOrderCount();
        $orderChange = $this->getPercentageChange($lastWeekOrderCount, $weeklyOrderCount);
        $orderColor = $this->getStatColor($orderChange);

        $weeklyRevenue = $this->getWeeklyRevenue();
        $lastWeekRevenue = $this->getLastWeekRevenue();
        $revenueChange = $this->getPercentageChange($lastWeekRevenue, $weeklyRevenue);
        $revenueColor = $this->getStatColor($revenueChange);

        return [
            Stat::make('Haftalık Gelen Müşteri Sayısı', $weeklyCustomerCount)
                ->color($customerColor)
                ->chart([$lastWeekCustomerCount, $weeklyCustomerCount])
                ->description($customerChange === null ? 'Karşılaştırma yapılacak veri bulunamadı' : 'Önceki haftaya göre %' . $customerChange)
                ->descriptionIcon($customerChange > 0 ? 'heroicon-m-arrow-trending-up' : ($customerChange < 0 ? 'heroicon-m-arrow-trending-down' : 'heroicon-m-minus')),

            Stat::make('Haftalık Gelen Sipariş Sayısı', $weeklyOrderCount)
                ->color($orderColor)
                ->chart([$lastWeekOrderCount, $weeklyOrderCount])
                ->description($orderChange === null ? 'Karşılaştırma yapılacak veri bulunamadı' : 'Önceki haftaya göre %' . $orderChange)
                ->descriptionIcon($orderChange > 0 ? 'heroicon-m-arrow-trending-up' : ($orderChange < 0 ? 'heroicon-m-arrow-trending-down' : 'heroicon-m-minus')),

            Stat::make('Haftalık Yapılan Ciro', number_format($weeklyRevenue, 0, ',', '.') . ' ₺')
                ->color($revenueColor)
                ->chart([$lastWeekRevenue, $weeklyRevenue])
                ->description($revenueChange === null ? 'Karşılaştırma yapılacak veri bulunamadı' : 'Önceki haftaya göre %' . $revenueChange)
                ->descriptionIcon($revenueChange > 0 ? 'heroicon-m-arrow-trending-up' : ($revenueChange < 0 ? 'heroicon-m-arrow-trending-down' : 'heroicon-m-minus')),
        ];
    }

    protected function getPercentageChange($lastWeekValue, $currentWeekValue): ?int
    {
        if ($lastWeekValue == 0) {
            return null; // Karşılaştırma yapılacak veri bulunamadı
        }

        return intval((($currentWeekValue - $lastWeekValue) / $lastWeekValue) * 100);
    }

    protected function getStatColor(?int $change): string
    {
        if ($change === null) {
            return 'success'; // Yeşil, veri bulunamadığında
        }

        if ($change > 0) {
            return 'success'; // Yeşil
        } elseif ($change < 0) {
            return 'danger'; // Kırmızı
        } else {
            return 'warning'; // Sarı
        }
    }
}
