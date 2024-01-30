<?php

namespace App\Filament\Resources\LiquidResource\Pages;

use App\Filament\Resources\LiquidResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLiquids extends ListRecords
{
    protected static string $resource = LiquidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
