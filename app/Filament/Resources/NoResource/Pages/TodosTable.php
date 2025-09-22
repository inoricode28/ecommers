<?php

namespace App\Filament\Resources\NoResource\Pages;

use App\Filament\Resources\NoResource; // ✅ Agregar esta importación
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Builder; // ✅ Importar Builder

class TodosTable extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = NoResource::class;
    protected static string $view = 'filament.resources.no-resource.pages.todos-table';

    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                $response = Http::get('https://jsonplaceholder.typicode.com/todos');
                return collect($response->json());
            })
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('completed')
                    ->label('Completada')
                    ->boolean()
                    ->sortable(),
            ])
            ->actions([ // ✅ Opcional: agregar acciones
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([ // ✅ Opcional: agregar acciones masivas
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}