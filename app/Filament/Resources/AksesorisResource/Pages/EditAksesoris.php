<?php

namespace App\Filament\Resources\AksesorisResource\Pages;

use App\Filament\Resources\AksesorisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAksesoris extends EditRecord
{
    protected static string $resource = AksesorisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index') ;
    }
}
