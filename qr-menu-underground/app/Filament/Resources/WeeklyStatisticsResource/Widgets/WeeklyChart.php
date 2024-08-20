<?php

namespace App\Filament\Resources\WeeklyStatisticsResource\Widgets;

use Carbon\Carbon;
use App\Models\PastOrder;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class WeeklyChart extends ChartWidget
{
    protected static ?string $heading = 'Bu Haftaki Günlük Müşteri Sayıları';

    protected function getData(): array
    {
        $currentDay = Carbon::now()->dayOfWeekIso;
        $startOfWeek = Carbon::now()->subDays($currentDay - 1)->startOfDay();
        $endOfWeek = Carbon::now()->endOfDay();
        $daysOfWeek = ['Pzt', 'Sal', 'Çar', 'Per', 'Cum', 'Cmt', 'Paz'];

        $dailyCustomerCounts = array_fill(0, 7, 0);

        $customers = PastOrder::select(
                DB::raw('DAYOFWEEK(created_at) as day_of_week'),
                DB::raw('SUM(customer) as customer_sum')
            )
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->groupBy(DB::raw('DAYOFWEEK(created_at)'))
            ->get();

        foreach ($customers as $customer) {
            $dayIndex = ($customer->day_of_week + 5) % 7;
            $dailyCustomerCounts[$dayIndex] = $customer->customer_sum;
        }

        $orderedDaysOfWeek = array_merge(
            array_slice($daysOfWeek, $currentDay, 7 - $currentDay),
            array_slice($daysOfWeek, 0, $currentDay)
        );
        $orderedCustomerCounts = array_merge(
            array_slice($dailyCustomerCounts, $currentDay, 7 - $currentDay),
            array_slice($dailyCustomerCounts, 0, $currentDay)
        );

        return [
            'datasets' => [
                [
                    'label' => 'Müşteri Sayısı',
                    'data' => $orderedCustomerCounts,
                ],
            ],
            'labels' => $orderedDaysOfWeek,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
