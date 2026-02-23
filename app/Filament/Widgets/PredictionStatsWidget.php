<?php

namespace App\Filament\Widgets;

use App\Models\Prediction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PredictionStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Активные руны', Prediction::where('category', 'rune')->where('is_active', true)->count())
                ->description('Всего активных рун')
                ->color('primary'),
            Stat::make('Активные свертки', Prediction::where('category', 'scroll')->where('is_active', true)->count())
                ->description('Всего активных свертков')
                ->color('success'),
            Stat::make('Всего активных', Prediction::where('is_active', true)->count())
                ->description('Все активные предсказания')
                ->color('info'),
        ];
    }
}
