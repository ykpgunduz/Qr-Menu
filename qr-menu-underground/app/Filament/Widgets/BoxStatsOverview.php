<?php

namespace App\Filament\Widgets;

use App\Models\PastOrder;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Carbon\Carbon;

class BoxStatsOverview extends BaseWidget
{
    protected function getPreviousDaysData(int $days = 7): array
    {
        $endDate = Carbon::yesterday()->endOfDay();
        $startDate = Carbon::yesterday()->subDays($days - 1)->startOfDay();

        return [
            'customer' => PastOrder::whereBetween('created_at', [$startDate, $endDate])->sum('customer') / $days,
            'order' => PastOrder::whereBetween('created_at', [$startDate, $endDate])->count() / $days,
            'revenue' => PastOrder::whereBetween('created_at', [$startDate, $endDate])->sum('total_amount') / $days,
        ];
    }

    protected function getDailyCustomerCount(): int
    {
        $todayEnd = Carbon::now()->endOfDay();
        return PastOrder::whereBetween('created_at', [Carbon::today(), $todayEnd])->sum('customer');
    }

    protected function getDailyOrderCount(): int
    {
        $todayEnd = Carbon::now()->endOfDay();
        return PastOrder::whereBetween('created_at', [Carbon::today(), $todayEnd])->count();
    }

    protected function getDailyRevenue(): float
    {
        $todayEnd = Carbon::now()->endOfDay();
        return PastOrder::whereBetween('created_at', [Carbon::today(), $todayEnd])->sum('total_amount');
    }

    protected function getWeeklyStats(): array
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $data = PastOrder::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'), DB::raw('sum(total_amount) as total_amount'))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->toArray();

        $chartData = [];
        $dates = [];

        for ($i = 0; $i <= 6; $i++) {
            $date = Carbon::now()->startOfWeek()->addDays($i)->format('Y-m-d');
            $dates[] = $date;
            $chartData[] = $data[$date] ?? 0;
        }

        return [
            'chartData' => $chartData,
            'dates' => $dates
        ];
    }

    protected function getStats(): array
    {
        $previousData = $this->getPreviousDaysData();
        $dailyCustomerCount = $this->getDailyCustomerCount();
        $dailyOrderCount = $this->getDailyOrderCount();
        $dailyRevenue = $this->getDailyRevenue();

        $previousCustomerCount = $previousData['customer'];
        $previousOrderCount = $previousData['order'];
        $previousRevenue = $previousData['revenue'];

        $customerChange = $previousCustomerCount > 0 ? (($dailyCustomerCount - $previousCustomerCount) / $previousCustomerCount) * 100 : null;
        $orderChange = $previousOrderCount > 0 ? (($dailyOrderCount - $previousOrderCount) / $previousOrderCount) * 100 : null;
        $revenueChange = $previousRevenue > 0 ? (($dailyRevenue - $previousRevenue) / $previousRevenue) * 100 : null;

        $customerColor = $customerChange === null ? 'success' : ($customerChange >= 0 ? 'success' : 'danger');
        $customerIcon = $customerChange === null ? 'heroicon-m-minus' : ($customerChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down');

        $orderColor = $orderChange === null ? 'success' : ($orderChange >= 0 ? 'success' : 'danger');
        $orderIcon = $orderChange === null ? 'heroicon-m-minus' : ($orderChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down');

        $revenueColor = $revenueChange === null ? 'success' : ($revenueChange >= 0 ? 'success' : 'danger');
        $revenueIcon = $revenueChange === null ? 'heroicon-m-minus' : ($revenueChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down');

        $weeklyStats = $this->getWeeklyStats();

        return [
            Stat::make('Günlük Gelen Müşteri Sayısı', $dailyCustomerCount)
                ->color($customerColor)
                ->chart($weeklyStats['chartData'])
                ->description($customerChange === null ? 'Karşılaştırma yapılacak veri bulunamadı' : number_format($customerChange) . '% önceki günlere göre daha ' . ($customerChange >= 0 ? 'fazla' : 'düşük'))
                ->descriptionIcon($customerIcon),

            Stat::make('Günlük Gelen Sipariş Sayısı', $dailyOrderCount)
                ->color($orderColor)
                ->chart($weeklyStats['chartData'])
                ->description($orderChange === null ? 'Karşılaştırma yapılacak veri bulunamadı' : number_format($orderChange) . '% önceki günlere göre daha ' . ($orderChange >= 0 ? 'fazla' : 'düşük'))
                ->descriptionIcon($orderIcon),

            Stat::make('Günlük Yapılan Ciro', number_format($dailyRevenue, 0, ',', '.') . ' ₺')
                ->color($revenueColor)
                ->chart($weeklyStats['chartData'])
                ->description($revenueChange === null ? 'Karşılaştırma yapılacak veri bulunamadı' : number_format($revenueChange) . '% önceki günlere göre daha ' . ($revenueChange >= 0 ? 'yüksek' : 'düşük'))
                ->descriptionIcon($revenueIcon),
        ];
    }
}
