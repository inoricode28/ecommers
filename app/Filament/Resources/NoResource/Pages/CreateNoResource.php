<?php

namespace App\Filament\Resources\NoResource\Pages;

use App\Filament\Resources\NoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNoResource extends CreateRecord
{
    protected static string $resource = NoResource::class;


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
