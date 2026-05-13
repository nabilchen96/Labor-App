<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Support\Enums\MaxWidth;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->plugin(FilamentApexChartsPlugin::make())
            ->maxContentWidth('full')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])

            ->navigationItems([
                NavigationItem::make('SOP')
                    ->url('https://drive.google.com/drive/folders/12db-NVMrltQCIP79prnsMbNRKLW2MWKi', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-globe-alt')
                    ->group('External Link')
                    ->sort(8),

                NavigationItem::make('Laporan Utilitas')
                    ->url('https://rebrand.ly/LAP-LAB', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-globe-alt')
                    ->group('External Link')
                    ->sort(9),

                NavigationItem::make('Absensi Personel')
                    ->url('https://forms.gle/A9Ka1rjrucgwedDXA', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-globe-alt')
                    ->group('External Link')
                    ->sort(10),

                NavigationItem::make('Manual Operation')
                    ->url('https://drive.google.com/drive/folders/11P0Y3-AS-ppQotCNDa4jv91WeWfIeh8w', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-globe-alt')
                    ->group('External Link')
                    ->sort(10),
            ])

            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
