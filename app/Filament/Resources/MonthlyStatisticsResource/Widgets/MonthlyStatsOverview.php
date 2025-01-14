<?php

namespace App\Filament\Resources\MonthlyStatisticsResource\Widgets;

use App\Models\PastOrder;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class MonthlyStatsOverview extends BaseWidget
{
    protected function getCurrentMonthDay(): int
    {
        return now()->day;
    }

    protected function getMonthlyCustomerCount(): int
    {
        return PastOrder::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->whereDay('created_at', '<=', $this->getCurrentMonthDay())
            ->sum('customer');
    }

    protected function getLastMonthCustomerCount(): int
    {
        $lastMonth = now()->subMonth();

        return PastOrder::whereYear('created_at', $lastMonth->year)
            ->whereMonth('created_at', $lastMonth->month)
            ->whereDay('created_at', '<=', $this->getCurrentMonthDay())
            ->sum('customer');
    }

    protected function getMonthlyOrderCount(): int
    {
        return PastOrder::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->whereDay('created_at', '<=', $this->getCurrentMonthDay())
            ->count();
    }

    protected function getLastMonthOrderCount(): int
    {
        $lastMonth = now()->subMonth();

        return PastOrder::whereYear('created_at', $lastMonth->year)
            ->whereMonth('created_at', $lastMonth->month)
            ->whereDay('created_at', '<=', $this->getCurrentMonthDay())
            ->count();
    }

    protected function getMonthlyRevenue(): float
    {
        return PastOrder::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->whereDay('created_at', '<=', $this->getCurrentMonthDay())
            ->sum('total_amount');
    }

    protected function getLastMonthRevenue(): float
    {
        $lastMonth = now()->subMonth();

        return PastOrder::whereYear('created_at', $lastMonth->year)
            ->whereMonth('created_at', $lastMonth->month)
            ->whereDay('created_at', '<=', $this->getCurrentMonthDay())
            ->sum('total_amount');
    }

    protected function getStats(): array
    {
        $monthlyCustomerCount = $this->getMonthlyCustomerCount();
        $lastMonthCustomerCount = $this->getLastMonthCustomerCount();
        $customerChange = $this->getPercentageChange($lastMonthCustomerCount, $monthlyCustomerCount);
        $customerColor = $this->getStatColor($customerChange);

        $monthlyOrderCount = $this->getMonthlyOrderCount();
        $lastMonthOrderCount = $this->getLastMonthOrderCount();
        $orderChange = $this->getPercentageChange($lastMonthOrderCount, $monthlyOrderCount);
        $orderColor = $this->getStatColor($orderChange);

        $monthlyRevenue = $this->getMonthlyRevenue();
        $lastMonthRevenue = $this->getLastMonthRevenue();
        $revenueChange = $this->getPercentageChange($lastMonthRevenue, $monthlyRevenue);
        $revenueColor = $this->getStatColor($revenueChange);

        return [
            Stat::make('Aylık Gelen Müşteri Sayısı', $monthlyCustomerCount)
                ->color($customerColor)
                ->chart([$lastMonthCustomerCount, $monthlyCustomerCount])
                ->description($customerChange === null ? 'Karşılaştırma yapılacak veri bulunamadı' : 'Geçen aya göre %' . $customerChange)
                ->descriptionIcon($customerChange > 0 ? 'heroicon-m-arrow-trending-up' : ($customerChange < 0 ? 'heroicon-m-arrow-trending-down' : 'heroicon-m-minus')),

            Stat::make('Aylık Gelen Sipariş Sayısı', $monthlyOrderCount)
                ->color($orderColor)
                ->chart([$lastMonthOrderCount, $monthlyOrderCount])
                ->description($orderChange === null ? 'Karşılaştırma yapılacak veri bulunamadı' : 'Geçen aya göre %' . $orderChange)
                ->descriptionIcon($orderChange > 0 ? 'heroicon-m-arrow-trending-up' : ($orderChange < 0 ? 'heroicon-m-arrow-trending-down' : 'heroicon-m-minus')),

            Stat::make('Aylık Yapılan Ciro', number_format($monthlyRevenue, 0, ',', '.') . ' ₺')
                ->color($revenueColor)
                ->chart([$lastMonthRevenue, $monthlyRevenue])
                ->description($revenueChange === null ? 'Karşılaştırma yapılacak veri bulunamadı' : 'Geçen aya göre %' . $revenueChange)
                ->descriptionIcon($revenueChange > 0 ? 'heroicon-m-arrow-trending-up' : ($revenueChange < 0 ? 'heroicon-m-arrow-trending-down' : 'heroicon-m-minus')),
        ];
    }

    protected function getPercentageChange($lastMonthValue, $currentMonthValue): ?int
    {
        if ($lastMonthValue == 0) {
            return null; // Karşılaştırma yapılacak veri bulunamadı
        }

        return intval((($currentMonthValue - $lastMonthValue) / $lastMonthValue) * 100);
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
