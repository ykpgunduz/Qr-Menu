<?php

namespace App\Filament\Resources\MonthlyStatisticsResource\Widgets;

use App\Models\PastOrder;
use Filament\Widgets\ChartWidget;

class MonthlyDrinkWidget extends ChartWidget
{
    protected static ?string $heading = 'Aylık İçilen İçecekler';

    protected function getData(): array
    {
        // Bu ayki siparişleri alıyoruz
        $monthlyOrders = PastOrder::whereMonth('created_at', now()->month)->get();

        // İçecek verilerini toplamak için bir dizi oluşturuyoruz
        $parsedData = [];

        // Her bir siparişin 'products' sütunundaki veriyi ayrıştırıyoruz
        foreach ($monthlyOrders as $order) {
            $lines = explode(',', $order->products);
            foreach ($lines as $line) {
                if (preg_match('/(\d+) x ([^=]+) = (\d+)₺/', trim($line), $matches)) {
                    $quantity = (int) $matches[1];
                    $productName = trim($matches[2]);

                    // Ürün adına göre miktarı topluyoruz
                    if (!isset($parsedData[$productName])) {
                        $parsedData[$productName] = 0;
                    }
                    $parsedData[$productName] += $quantity;
                }
            }
        }

        // İçecek isimleri ve miktarlarını ayırıyoruz
        $beverageLabels = array_keys($parsedData);
        $beverageQuantities = array_values($parsedData);

        // Koyu pastel tonlarında renkler tanımlıyoruz
        $colors = [
            '#1F3A93', '#E74C3C', '#2C3E50', '#27AE60', '#8E44AD',
            '#F39C12', '#D35400', '#0D3C6E', '#C8102E', '#1C1C1C'
        ];

        // Renkler listesine veri kümesi için renkleri atıyoruz
        $backgroundColor = array_slice($colors, 0, count($beverageLabels));

        return [
            'datasets' => [
                [
                    'label' => 'İçecek Miktarı',
                    'data' => $beverageQuantities,
                    'backgroundColor' => $backgroundColor,
                ],
            ],
            'labels' => $beverageLabels,
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
