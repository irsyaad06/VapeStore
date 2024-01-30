<?php

namespace App\Filament\Resources\LiquidResource\Pages;

use App\Filament\Resources\LiquidResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLiquid extends CreateRecord
{
    protected static string $resource = LiquidResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
