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
        $currentDay = Carbon::now()->dayOfWeekIso; // 1 (Monday) to 7 (Sunday)
        $startOfWeek = Carbon::now()->subDays($currentDay - 1)->startOfDay(); // Start of the current day minus (current day - 1)
        $endOfWeek = Carbon::now()->endOfDay(); // End of the current day
        $daysOfWeek = ['Pzt', 'Sal', 'Çar', 'Per', 'Cum', 'Cmt', 'Paz'];

        $dailyCustomerCounts = array_fill(0, 7, 0);

        $customers = PastOrder::select(
                DB::raw('DAYOFWEEK(created_at) as day_of_week'),
                DB::raw('COUNT(DISTINCT session_id) as customer_count')
            )
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->groupBy(DB::raw('DAYOFWEEK(created_at)'))
            ->get();

        foreach ($customers as $customer) {
            $dayIndex = ($customer->day_of_week + 5) % 7;
            $dailyCustomerCounts[$dayIndex] = $customer->customer_count;
        }

        // Reorder the labels and data so that the current day is last
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
