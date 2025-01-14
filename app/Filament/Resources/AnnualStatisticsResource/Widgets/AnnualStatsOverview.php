<?php

namespace App\Filament\Resources\AnnualStatisticsResource\Widgets;

use App\Models\PastOrder;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class AnnualStatsOverview extends BaseWidget
{
    protected function getCurrentYearDayOfYear(): int
    {
        return now()->dayOfYear;
    }

    protected function getAnnualCustomerCount(): int
    {
        return PastOrder::whereYear('created_at', now()->year)
            ->where(DB::raw('DAYOFYEAR(created_at)'), '<=', $this->getCurrentYearDayOfYear())
            ->sum('customer');
    }

    protected function getLastYearCustomerCount(): int
    {
        $lastYear = now()->subYear();

        return PastOrder::whereYear('created_at', $lastYear->year)
            ->where(DB::raw('DAYOFYEAR(created_at)'), '<=', $this->getCurrentYearDayOfYear())
            ->sum('customer');
    }

    protected function getAnnualOrderCount(): int
    {
        return PastOrder::whereYear('created_at', now()->year)
            ->where(DB::raw('DAYOFYEAR(created_at)'), '<=', $this->getCurrentYearDayOfYear())
            ->count();
    }

    protected function getLastYearOrderCount(): int
    {
        $lastYear = now()->subYear();

        return PastOrder::whereYear('created_at', $lastYear->year)
            ->where(DB::raw('DAYOFYEAR(created_at)'), '<=', $this->getCurrentYearDayOfYear())
            ->count();
    }

    protected function getAnnualRevenue(): float
    {
        return PastOrder::whereYear('created_at', now()->year)
            ->where(DB::raw('DAYOFYEAR(created_at)'), '<=', $this->getCurrentYearDayOfYear())
            ->sum('total_amount');
    }

    protected function getLastYearRevenue(): float
    {
        $lastYear = now()->subYear();

        return PastOrder::whereYear('created_at', $lastYear->year)
            ->where(DB::raw('DAYOFYEAR(created_at)'), '<=', $this->getCurrentYearDayOfYear())
            ->sum('total_amount');
    }

    protected function getStats(): array
    {
        $annualCustomerCount = $this->getAnnualCustomerCount();
        $lastYearCustomerCount = $this->getLastYearCustomerCount();
        $customerChange = $this->getPercentageChange($lastYearCustomerCount, $annualCustomerCount);
        $customerColor = $this->getStatColor($customerChange);

        $annualOrderCount = $this->getAnnualOrderCount();
        $lastYearOrderCount = $this->getLastYearOrderCount();
        $orderChange = $this->getPercentageChange($lastYearOrderCount, $annualOrderCount);
        $orderColor = $this->getStatColor($orderChange);

        $annualRevenue = $this->getAnnualRevenue();
        $lastYearRevenue = $this->getLastYearRevenue();
        $revenueChange = $this->getPercentageChange($lastYearRevenue, $annualRevenue);
        $revenueColor = $this->getStatColor($revenueChange);

        return [
            Stat::make('Yıllık Gelen Müşteri Sayısı', $annualCustomerCount)
                ->color($customerColor)
                ->chart([$lastYearCustomerCount, $annualCustomerCount])
                ->description($customerChange === null ? 'Karşılaştırma yapılacak veri bulunamadı' : 'Geçen yıla göre %' . $customerChange)
                ->descriptionIcon($customerChange > 0 ? 'heroicon-m-arrow-trending-up' : ($customerChange < 0 ? 'heroicon-m-arrow-trending-down' : 'heroicon-m-minus')),

            Stat::make('Yıllık Gelen Sipariş Sayısı', $annualOrderCount)
                ->color($orderColor)
                ->chart([$lastYearOrderCount, $annualOrderCount])
                ->description($orderChange === null ? 'Karşılaştırma yapılacak veri bulunamadı' : 'Geçen yıla göre %' . $orderChange)
                ->descriptionIcon($orderChange > 0 ? 'heroicon-m-arrow-trending-up' : ($orderChange < 0 ? 'heroicon-m-arrow-trending-down' : 'heroicon-m-minus')),

            Stat::make('Yıllık Yapılan Ciro', number_format($annualRevenue, 0, ',', '.') . ' ₺')
                ->color($revenueColor)
                ->chart([$lastYearRevenue, $annualRevenue])
                ->description($revenueChange === null ? 'Karşılaştırma yapılacak veri bulunamadı' : 'Geçen yıla göre %' . $revenueChange)
                ->descriptionIcon($revenueChange > 0 ? 'heroicon-m-arrow-trending-up' : ($revenueChange < 0 ? 'heroicon-m-arrow-trending-down' : 'heroicon-m-minus')),
        ];
    }

    protected function getPercentageChange($lastYearValue, $currentYearValue): ?int
    {
        if ($lastYearValue == 0) {
            return null; // Karşılaştırma yapılacak veri bulunamadı
        }

        return intval((($currentYearValue - $lastYearValue) / $lastYearValue) * 100);
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
