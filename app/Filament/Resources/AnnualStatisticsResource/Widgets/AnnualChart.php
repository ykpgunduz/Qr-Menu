<?php

namespace App\Filament\Resources\AnnualStatisticsResource\Widgets;

use Carbon\Carbon;
use App\Models\PastOrder;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class AnnualChart extends ChartWidget
{
    protected static ?string $heading = 'Kafemizi Ziyaret Eden Müşteriler';

    protected function getData(): array
    {
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();
        $monthlyCustomerCounts = array_fill(0, 12, 0);

        $customers = PastOrder::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(customer) as customer_count')
            )
            ->whereBetween('created_at', [$startOfYear, $endOfYear])
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        foreach ($customers as $customer) {
            $monthlyCustomerCounts[$customer->month - 1] = $customer->customer_count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Müşteri Sayısı',
                    'data' => $monthlyCustomerCounts,
                ],
            ],
            'labels' => ["Oca", "Şub", "Mar", "Nis", "May", "Haz", "Tem", "Ağu", "Eyl", "Eki", "Kas", "Ara"],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
