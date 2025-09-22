<?php

namespace App\Filament\Resources\NoResource\Pages;

use App\Filament\Resources\NoResource;
use Filament\Resources\Pages\Page;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class TodoModel extends Model
{
    protected $fillable = ['id', 'title', 'completed', 'userId'];
    protected $casts = ['completed' => 'boolean'];
    public $timestamps = false;
    protected $table = null;
}

class TodosTable extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = NoResource::class;
    protected static string $view = 'filament.resources.no-resource.pages.todos-table';

    public function table(Table $table): Table
    {
        return $table
            ->query(TodoModel::query())
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('title')->label('Título')->searchable()->wrap(),
                IconColumn::make('completed')->label('Completada')->boolean()->sortable(),
                TextColumn::make('userId')->label('Usuario ID')->sortable(),
            ])
            ->paginated(true)
            ->defaultPaginationPageOption(25);
    }

    public function getTableRecords(): Collection
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/todos');

        return collect($response->json())->map(function ($todo) {
            $model = new TodoModel($todo);
            $model->exists = true;
            $model->setRawAttributes($todo, true);
            return $model;
        })->pipe(fn($models) => new Collection($models->all()));
    }
}
