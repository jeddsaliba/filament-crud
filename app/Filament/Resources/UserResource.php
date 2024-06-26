<?php

namespace App\Filament\Resources;

use App\Enums\Notifications;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\View\Components\Modal;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'User Management';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        Section::make(function($operation) {
                            $title = 'Basic Information';
                            switch($operation) {
                                case 'edit': $title = "Update $title"; break;
                                case 'create': $title = "Create $title"; break;
                                default: $title; break;
                            }
                            return $title;
                        })
                        ->description(function($operation) {
                            $description = null;
                            switch($operation) {
                                case 'edit': $description = "Update user's basic information here."; break;
                                case 'create': $description = "Please enter user's basic information here."; break;
                                default: $description; break;
                            }
                            return $description;
                        })
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->columnSpan([
                                    'xl' => 2,
                                    'lg' => 1
                                ]),
                            Forms\Components\Select::make('role_id')
                                ->label('Role')
                                ->relationship('role', 'name')
                                ->preload()
                                ->searchable()
                                ->selectablePlaceholder(false)
                                ->required()
                                ->default(1)
                                ->columnSpan([
                                    'xl' => 1,
                                    'lg' => 1
                                ]),
                            Forms\Components\TextInput::make('email')
                                ->email()
                                ->unique(ignoreRecord: true)
                                ->required()
                                ->maxLength(255)
                                ->columnSpanFull()
                        ])
                        ->columns([
                            'xl' => 3,
                            'lg' => 1,
                            'md' => 2
                        ])
                        ->columnSpan([
                            'xl' => 2,
                            'lg' => 1
                        ]),
                        Section::make('Profile Photo')
                            ->description('Upload user\'s profile photo here.')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->hiddenLabel()
                                    ->image()
                                    ->directory('users/thumbnails')
                                    ->imageEditor(fn($operation) => $operation !== 'view')
                                    ->imageCropAspectRatio('1:1')
                            ])->columnSpan([
                                'xl' => 1
                            ]),
                        Section::make('Password Manager')
                            ->description(function($operation) {
                                $description = null;
                                switch($operation) {
                                    case 'edit': $description = "Update user's password here."; break;
                                    case 'create': $description = "Please enter user's password here."; break;
                                    default: $description; break;
                                }
                                return $description;
                            })
                            ->schema([
                                Forms\Components\TextInput::make('password')
                                    ->password()
                                    ->required()
                                    ->rule(Password::default())
                                    ->maxLength(255)
                                    ->autocomplete('new-password')
                                        ->dehydrateStateUsing(fn ($state): string => Hash::make($state))
                                        ->live(debounce: 500)
                                        ->same('passwordConfirmation')
                                        ->revealable(),
                                Forms\Components\TextInput::make('passwordConfirmation')
                                    ->label('Confirm Password')
                                    ->password()
                                    ->required()
                                    ->dehydrated(false)
                                    ->revealable(),
                            ])->visibleOn('create')
                            ->columnSpan([
                                'xl' => 2,
                                'lg' => 1
                            ])
                    ])->columns([
                        'xl' => 3,
                        'lg' => 1
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Profile Photo'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\SelectColumn::make('role_id')
                    ->label('Role')
                    ->options(Role::withTrashed()->pluck('name', 'id'))
                    ->selectablePlaceholder(false)
                    ->sortable()
                    ->action(fn(Modal $modal) => $modal),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->action(function (User $record) {
                        if ($record->projects->isNotEmpty()) {
                            Notification::make()
                                ->danger()
                                ->title(Notifications::DEFAULT_FAILED_TITLE)
                                ->body(Notifications::USER_PROJECT_CREATED_DELETE_FAILED_BODY)
                                ->send();
                            return;
                        } else if ($record->tasksCreated->isNotEmpty()) {
                            Notification::make()
                                ->danger()
                                ->title(Notifications::DEFAULT_FAILED_TITLE)
                                ->body(Notifications::USER_TASK_CREATED_DELETE_FAILED_BODY)
                                ->send();
                            return;
                        } else if ($record->tasks->isNotEmpty()) {
                            Notification::make()
                                ->danger()
                                ->title(Notifications::DEFAULT_FAILED_TITLE)
                                ->body(Notifications::USER_TASK_ASSIGNED_DELETE_FAILED_BODY)
                                ->send();
                            return;
                        }
                        Notification::make()
                            ->success()
                            ->title(Notifications::DEFAULT_SUCCESS_TITLE)
                            ->send();
                        $record->delete();
                    }),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(), 
                    Tables\Actions\RestoreBulkAction::make()
                ]),
            ])->query(function (User $query) {
                return $query->whereNot('id', Auth::id());
            });
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->whereNot('id', '=', Auth::id());
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            $record->email,
            $record->role->name
        ];
    }
    /** Let's you edit deleted record */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('id', '!=', Auth::id())->count();
    }
}
