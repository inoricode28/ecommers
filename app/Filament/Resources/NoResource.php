<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NoResource\Pages;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Builder;

class NoResource extends Resource
{
    protected static ?string $model = Todo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'No Resource';
    protected static ?string $modelLabel = 'No Resource';
    protected static ?string $pluralModelLabel = 'No Resources';

    // --------------------------
    // FORMULARIO
    // --------------------------
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Título')
                ->required()
                ->maxLength(255),

            Forms\Components\Toggle::make('completed')
                ->label('Completado')
                ->default(false),

            Forms\Components\Select::make('user_id')
                ->label('Usuario')
                ->relationship('User', 'name')
              //  ->searchable()
                ->required(),
        ]);
    }

    // --------------------------
    // TABLA
    // --------------------------
    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id')->sortable(),
            Tables\Columns\TextColumn::make('title')->searchable(),
            Tables\Columns\IconColumn::make('completed')
                ->boolean()
                ->label('Completado'),
            Tables\Columns\TextColumn::make('user.name')->label('Usuario'),
           // Tables\Columns\TextColumn::make('created_at')->dateTime(),
           // Tables\Columns\TextColumn::make('updated_at')->dateTime(),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    // --------------------------
    // PÁGINAS
    // --------------------------
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNoResources::route('/'),
            'create' => Pages\CreateNoResource::route('/create'),
            //'edit' => Pages\EditNoResource::route('/{record}/edit'),
            'todos' => Pages\TodosTable::route('/todos'),
        ];
    }
}
