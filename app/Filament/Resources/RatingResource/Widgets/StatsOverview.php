<?php

namespace App\Filament\Resources\RatingResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Rating;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $data = Rating::query()
            ->selectRaw('
                AVG(service_rating) as service_avg,
                AVG(product_rating) as product_avg,
                AVG(ambiance_rating) as ambiance_avg,
                SUM(return_response = "yes") as yes_count,
                SUM(return_response = "no") as no_count
            ')
            ->first();

        return [
            Stat::make(__('Hizmet Ortalaması'), '★ ' . number_format($data->service_avg, 2))
                ->description(__('Size verilen servisten memnun kaldınız mı?'))
                ->color($this->getColorByScore($data->service_avg)),

            Stat::make(__('Ürün Ortalaması'), '★ ' . number_format($data->product_avg, 2))
                ->description(__('Size servis edilen ürünlerden memnun kaldınız mı?'))
                ->color($this->getColorByScore($data->product_avg)),

            Stat::make(__('Ortam Ortalaması'), '★ ' . number_format($data->ambiance_avg, 2))
                ->description(__('İşletmenin genel ambiansı (müzik, temizlik vs.) nasıldı?'))
                ->color($this->getColorByScore($data->ambiance_avg)),

            Stat::make(__('Evet / Hayır Sayısı'), "{$data->yes_count} / {$data->no_count}")
                ->description(__('Tekrar bu işletmeye gelir misiniz?'))
                ->color('primary'),
        ];
    }

    /**
     * Puan değerine göre renk belirleyen yardımcı fonksiyon.
     */
    protected function getColorByScore($score)
    {
        if ($score <= 2) {
            return 'danger'; // Kırmızı renk
        } elseif ($score <= 3) {
            return 'warning'; // Sarı renk
        } else {
            return 'success'; // Yeşil renk
        }
    }
}
