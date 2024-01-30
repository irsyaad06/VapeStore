<?php

namespace App\Filament\Resources\AksesorisResource\Pages;

use App\Filament\Resources\AksesorisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAksesoris extends ListRecords
{
    protected static string $resource = AksesorisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
