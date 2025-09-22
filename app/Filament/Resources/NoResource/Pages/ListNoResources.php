<?php

namespace App\Filament\Resources\NoResource\Pages;

use App\Filament\Resources\NoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNoResources extends ListRecords
{
    protected static string $resource = NoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
