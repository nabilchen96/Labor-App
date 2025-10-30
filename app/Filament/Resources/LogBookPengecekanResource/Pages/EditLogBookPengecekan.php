<?php

namespace App\Filament\Resources\LogBookPengecekanResource\Pages;

use App\Filament\Resources\LogBookPengecekanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLogBookPengecekan extends EditRecord
{
    protected static string $resource = LogBookPengecekanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
