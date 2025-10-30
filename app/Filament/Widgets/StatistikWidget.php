<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\User;
use App\Models\Laboratorium;
use App\Models\AlatLaboratorium;
use App\Models\Instruktur;

class StatistikWidget extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total User', User::count())
                ->icon('heroicon-o-user-group')
                ->color('primary'),

            Card::make('Total Laboratorium', Laboratorium::count())
                ->icon('heroicon-o-building-office')
                ->color('success'),

            Card::make('Total Alat', AlatLaboratorium::count())
                ->icon('heroicon-o-cog')
                ->color('warning'),

            Card::make('Total Instruktur', Instruktur::count())
                ->icon('heroicon-o-academic-cap')
                ->color('info'),
        ];
    }
}
