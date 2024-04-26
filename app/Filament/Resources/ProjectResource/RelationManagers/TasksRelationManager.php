<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TasksRelationManager extends RelationManager
{
    protected static string $relationship = 'tasks';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        Grid::make()
                            ->schema([
                                Forms\Components\Hidden::make('created_by')
                                    ->dehydrateStateUsing(fn($state) => Auth::id()),
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(debounce: 500)
                                    ->afterStateUpdated(function ($operation, $state, $set) {
                                        if ($operation === 'edit') return;
                                        $set('slug', Str::slug($state));
                                    })->columnSpan(2),
                                Forms\Components\Select::make('status_id')
                                    ->relationship('status', 'name')
                                    ->selectablePlaceholder(false)
                                    ->default(1)
                                    ->required(),
                                Forms\Components\Select::make('assigned_to')
                                    ->label('Assigned To')
                                    ->relationship('assigned', 'name')
                                    ->selectablePlaceholder(false)
                                    ->searchable()
                                    ->required(),
                                Forms\Components\DatePicker::make('start_date')
                                    ->default(now())
                                    ->required(),
                                Forms\Components\DatePicker::make('end_date')
                                    ->default(now())
                                    ->required(),
                                Forms\Components\RichEditor::make('description')
                                    ->required()
                                    ->fileAttachmentsDirectory('tasks/attachments')
                                    ->columnSpanFull()
                            ])->columnSpan(2)->columns(3),
                        Section::make('Meta')
                            ->description(fn($operation) => $operation === 'edit' ? 'Update your task meta information here.' : 'Enter your new task meta information here.')
                            ->schema([
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                Forms\Components\Select::make('tags')
                                    ->placeholder('Select tag(s)')
                                    ->relationship('tags', 'name')
                                    ->searchable()
                                    ->multiple()
                                    ->columnSpanFull()
                            ])->columnSpan(1)
                    ])->columns(3)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->limit(25)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }
                        return $state;
                    }),
                Tables\Columns\TextColumn::make('slug')
                    ->sortable()
                    ->searchable()
                    ->limit(25)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }
                        return $state;
                    }),
                Tables\Columns\TextColumn::make('creator.name')
                    ->label('Created By')
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('assigned.name')
                    ->label('Assigned To')
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\SelectColumn::make('status_id')
                    ->label('Status')
                    ->options(\App\Models\Status::all()->pluck('name', 'id'))
                    ->selectablePlaceholder(false)
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('M d, Y H:i A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('M d, Y H:i A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime('M d, Y H:i A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actionsColumnLabel('Actions')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(), 
                    Tables\Actions\RestoreBulkAction::make()
                ]),
            ]);
    }
}
