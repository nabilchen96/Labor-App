<?php

namespace App\Filament\Resources\PenggunaanAlatResource\Pages;

use App\Filament\Resources\PenggunaanAlatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenggunaanAlat extends EditRecord
{
    protected static string $resource = PenggunaanAlatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
