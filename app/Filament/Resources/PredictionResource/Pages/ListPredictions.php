<?php

namespace App\Filament\Resources\PredictionResource\Pages;

use App\Filament\Resources\PredictionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPredictions extends ListRecords
{
    protected static string $resource = PredictionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Создать предсказание'),
        ];
    }
    
    public function getTitle(): string
    {
        return 'Предсказания';
    }
    
    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\PredictionStatsWidget::class,
        ];
    }
}
