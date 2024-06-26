<?php

namespace App\Filament\Resources\TagResource\RelationManagers;

use Filament\Forms;
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
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Select::make('project_id')
                                    ->relationship('project', 'name')
                                    ->selectablePlaceholder(false)
                                    ->searchable()
                                    ->required()
                                    ->columnSpanFull()
                                    ->hiddenOn('edit'),
                                Forms\Components\Hidden::make('created_by')
                                    ->dehydrateStateUsing(fn($state) => Auth::id())
                                    ->hiddenOn('edit'),
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(debounce: 500)
                                    ->afterStateUpdated(function ($operation, $state, $set) {
                                        if ($operation === 'edit') return;
                                        $set('slug', Str::slug($state));
                                    })->columnSpan(2),
                                Forms\Components\Select::make('status_id')
                                    ->default(1)
                                    ->preload()
                                    ->relationship('status', 'name')
                                    ->required()
                                    ->searchable()
                                    ->selectablePlaceholder(false),
                                Forms\Components\Select::make('assigned_to')
                                    ->label('Assigned To')
                                    ->relationship('assigned', 'name')
                                    ->selectablePlaceholder(false)
                                    ->searchable()
                                    ->preload()
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
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                Forms\Components\Select::make('tags')
                                    ->columnSpanFull()
                                    ->multiple()
                                    ->placeholder('Select tag(s)')
                                    ->relationship('tags', 'name')
                                    ->searchable()
                            ])->columnSpan(1)
                    ])->columns(3)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('project.name')
                    ->sortable(),
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
                Tables\Filters\SelectFilter::make('Status')
                    ->relationship('status', 'name')
                    ->multiple()
                    ->preload(),
                Tables\Filters\SelectFilter::make('Assigned To')
                    ->label('Assigned To')
                    ->relationship('assigned', 'name')
                    ->multiple(),
                Tables\Filters\SelectFilter::make('Created By')
                    ->label('Created By')
                    ->relationship('creator', 'name')
                    ->multiple(),
                Tables\Filters\TrashedFilter::make()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make()
            ])
            ->actionsColumnLabel('Actions')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(), 
                    Tables\Actions\RestoreBulkAction::make()
                ]),
            ]);
    }
}
