<?php

namespace App\Filament\Resources\PastOrderResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\PastOrder;
use Carbon\Carbon;

class PastOrderWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $now = Carbon::now();

        if ($now->hour < 3) {
            $date = Carbon::yesterday();
        } else {
            $date = Carbon::today();
        }

        $morningStart = $date->copy()->setTime(10, 0);
        $morningEnd = $date->copy()->setTime(13, 59);
        $afternoonStart = $date->copy()->setTime(14, 0);
        $afternoonEnd = $date->copy()->setTime(17, 59);
        $eveningStart = $date->copy()->setTime(18, 0);
        $eveningEnd = $date->copy()->setTime(23, 59);

        $morningRevenue = PastOrder::whereBetween('created_at', [$morningStart, $morningEnd])
            ->sum('total_amount');
        $morningCustomers = PastOrder::whereBetween('created_at', [$morningStart, $morningEnd])
            ->sum('customer');

        $afternoonRevenue = PastOrder::whereBetween('created_at', [$afternoonStart, $afternoonEnd])
            ->sum('total_amount');
        $afternoonCustomers = PastOrder::whereBetween('created_at', [$afternoonStart, $afternoonEnd])
            ->sum('customer');

        $eveningRevenue = PastOrder::whereBetween('created_at', [$eveningStart, $eveningEnd])
            ->sum('total_amount');
        $eveningCustomers = PastOrder::whereBetween('created_at', [$eveningStart, $eveningEnd])
            ->sum('customer');

        $morningAverage = $morningCustomers > 0 ? $morningRevenue / $morningCustomers : 0;
        $afternoonAverage = $afternoonCustomers > 0 ? $afternoonRevenue / $afternoonCustomers : 0;
        $eveningAverage = $eveningCustomers > 0 ? $eveningRevenue / $eveningCustomers : 0;

        return [
            Stat::make('Bugün Sabah (10.00 - 14.00)', number_format($morningRevenue) . "₺ | " . number_format($morningCustomers) . " Kişi")
                ->description('Kişi başına düşen hesap tutarı: ' . number_format($morningAverage, 1) . '₺'),

            Stat::make('Bugün Öğlen (14.00 - 18.00)', number_format($afternoonRevenue) . "₺ | " . number_format($afternoonCustomers) . " Kişi")
                ->description('Kişi başına düşen hesap tutarı: ' . number_format($afternoonAverage, 1) . '₺'),

            Stat::make('Bugün Akşam (18.00 - 23.59)', number_format($eveningRevenue) . "₺ | " . number_format($eveningCustomers) . " Kişi")
                ->description('Kişi başına düşen hesap tutarı: ' . number_format($eveningAverage, 1) . '₺'),
        ];
    }
}
