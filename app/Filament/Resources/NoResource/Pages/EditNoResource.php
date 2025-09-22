<?php

namespace App\Filament\Resources\NoResource\Pages;

use App\Filament\Resources\NoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNoResource extends EditRecord
{
    protected static string $resource = NoResource::class;

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