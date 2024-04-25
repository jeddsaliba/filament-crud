<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Filament\Resources\ProjectResource\RelationManagers\TasksRelationManager;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationGroup = 'Project Management';

    protected static ?int $navigationSort = 0;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';
    
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        Section::make(fn($operation) => $operation === 'edit' ? 'Update Project Information' : 'Create Project Information')
                            ->description(fn($operation) => $operation === 'edit' ? 'Update your project information here.' : 'Enter your new project information here.')
                            ->schema([
                                Forms\Components\Hidden::make('created_by')
                                    ->dehydrateStateUsing(fn($state) => Auth::id())
                                    ->hiddenOn('edit'),
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(debounce: 500)
                                    ->columnSpanFull()
                                    ->afterStateUpdated(function ($operation, $state, $set) {
                                        if ($operation === 'edit') return;
                                        $set('slug', Str::slug($state));
                                    }),
                                Forms\Components\RichEditor::make('description')
                                    ->required()
                                    ->columnSpanFull()
                                    ->fileAttachmentsDirectory('projects/attachments'),
                            ])->columnSpan(2)->columns(3),
                        Section::make('Meta')
                            ->description(fn($operation) => $operation === 'edit' ? 'Update your project meta information here.' : 'Enter your new project meta information here.')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->label('Thumbnail')
                                    ->image()
                                    ->directory('projects/thumbnails')
                                    ->imageEditor()
                                    ->imageCropAspectRatio('1:1'),
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                Forms\Components\Select::make('tags')
                                    ->relationship('tags', 'name')
                                    ->searchable()
                                    ->multiple()
                                    ->columnSpanFull()
                            ])->columnSpan(1)
                    ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Thumbnail'),
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
                    })
                    ->toggleable(),
                Tables\Columns\TextColumn::make('creator.name')
                    ->label('Created By')
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('M d, Y h:i A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('M d, Y h:i A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime('M d, Y h:i A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('Tags')
                    ->relationship('tags', 'name')
                    ->multiple(),
                Tables\Filters\SelectFilter::make('Created By')
                    ->label('Created By')
                    ->relationship('creator', 'name')
                    ->multiple(),
                Tables\Filters\TrashedFilter::make()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make()
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

    public static function getRelations(): array
    {
        return [
            TasksRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'slug', 'description', 'creator.name'];
    }
    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Created By' => $record->creator->name
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
