<?php

namespace App\Filament\Resources\LiquidResource\Pages;

use App\Filament\Resources\LiquidResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLiquid extends EditRecord
{
    protected static string $resource = LiquidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
