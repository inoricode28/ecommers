<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NoResource\Pages;
use App\Filament\Resources\NoResource\Pages\TodosTable;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model; // ✅ Importar Model

class NoResource extends Resource
{
    protected static ?string $model = \App\Models\Todo::class; // ✅ Usar un modelo existente o crear uno
    
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'No Resource';
    protected static ?string $modelLabel = 'No Resource';
    protected static ?string $pluralModelLabel = 'No Resources';

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNoResources::route('/'),
            'create' => Pages\CreateNoResource::route('/create'),
            'edit' => Pages\EditNoResource::route('/{record}/edit'),
            'todos' => TodosTable::route('/todos'), // ✅ Ruta personalizada
        ];
    }

    // ✅ Si no tienes un modelo, usa este método
    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }
}