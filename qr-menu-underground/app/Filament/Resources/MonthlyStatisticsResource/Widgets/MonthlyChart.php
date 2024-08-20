<?php

namespace App\Filament\Resources\MonthlyStatisticsResource\Widgets;

use Carbon\Carbon;
use App\Models\PastOrder;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class MonthlyChart extends ChartWidget
{
    protected static ?string $heading = 'Bu Ayki Günlük Müşteri Sayıları';

    protected function getData(): array
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $daysInMonth = Carbon::now()->daysInMonth;
        $dailyCustomerCounts = array_fill(0, $daysInMonth, 0);

        $customers = PastOrder::select(
                DB::raw('DAY(created_at) as day'),
                DB::raw('SUM(customer) as customer_count')
            )
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->groupBy(DB::raw('DAY(created_at)'))
            ->get();

        foreach ($customers as $customer) {
            $dailyCustomerCounts[$customer->day - 1] = $customer->customer_count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Müşteri Sayısı',
                    'data' => $dailyCustomerCounts,
                ],
            ],
            'labels' => range(1, $daysInMonth),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
