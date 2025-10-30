<?php

namespace App\Filament\Resources\AlatLaboratoriumResource\Pages;

use App\Filament\Resources\AlatLaboratoriumResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAlatLaboratorium extends EditRecord
{
    protected static string $resource = AlatLaboratoriumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
