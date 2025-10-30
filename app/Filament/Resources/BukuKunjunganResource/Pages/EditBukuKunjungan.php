<?php

namespace App\Filament\Resources\BukuKunjunganResource\Pages;

use App\Filament\Resources\BukuKunjunganResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBukuKunjungan extends EditRecord
{
    protected static string $resource = BukuKunjunganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
