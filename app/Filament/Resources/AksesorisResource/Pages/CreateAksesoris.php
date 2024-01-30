<?php

namespace App\Filament\Resources\AksesorisResource\Pages;

use App\Filament\Resources\AksesorisResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAksesoris extends CreateRecord
{
    protected static string $resource = AksesorisResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index') ;
    }
}
