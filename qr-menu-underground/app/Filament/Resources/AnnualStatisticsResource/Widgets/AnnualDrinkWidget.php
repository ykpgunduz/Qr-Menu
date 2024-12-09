<?php

namespace App\Filament\Resources\AnnualStatisticsResource\Widgets;

use App\Models\PastOrder;
use Filament\Widgets\ChartWidget;

class AnnualDrinkWidget extends ChartWidget
{
    protected static ?string $heading = 'Yıllık İçilen İçecekler';

    protected function getData(): array
    {
        $annualOrders = PastOrder::whereYear('created_at', now()->year)->get();
        $parsedData = [];

        foreach ($annualOrders as $order) {
            $lines = explode(',', $order->products);
            foreach ($lines as $line) {
                if (preg_match('/(\d+) x ([^=]+) = (\d+)₺/', trim($line), $matches)) {
                    $quantity = (int) $matches[1];
                    $productName = trim($matches[2]);

                    if (!isset($parsedData[$productName])) {
                        $parsedData[$productName] = 0;
                    }
                    $parsedData[$productName] += $quantity;
                }
            }
        }

        $beverageLabels = array_keys($parsedData);
        $beverageQuantities = array_values($parsedData);

        $colors = [
            '#1F3A93', '#E74C3C', '#2C3E50', '#27AE60', '#8E44AD',
            '#F39C12', '#D35400', '#0D3C6E', '#C8102E', '#1C1C1C'
        ];

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
