<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class StatistikPeminjaman extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static string $view = 'filament.pages.statistik-peminjaman';
    protected static ?string $navigationLabel = 'Laboratorium dan Alat';
    protected static ?string $title = 'Laboratorium dan Alat';

    // Tambahkan ini untuk grup menu
    protected static ?string $navigationGroup = 'Statistik';

    // Urutannya (semakin besar angkanya, semakin ke bawah)
    protected static ?int $navigationSort = 2;
}
