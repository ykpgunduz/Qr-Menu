<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CustomerChart extends ChartWidget
{
    protected static ?string $heading = 'Kafemizi Ziyaret Eden Müşteriler';

    protected function getData(): array
    {
        // Geçerli yılın verilerini almak için başlangıç ve bitiş tarihlerini belirleyin
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();

        // Her ay için müşteri sayısını tutacak bir dizi oluşturun
        $monthlyCustomerCounts = array_fill(0, 12, 0);

        // Veritabanından session_id'leri ay bazında gruplama ve sayma işlemi
        $customers = Cart::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(DISTINCT session_id) as customer_count')
            )
            ->whereBetween('created_at', [$startOfYear, $endOfYear])
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        // Müşteri verilerini aylara göre sayarak diziye ekleyin
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
        return 'line';
    }
}
