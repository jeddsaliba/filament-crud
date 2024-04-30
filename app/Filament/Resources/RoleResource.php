<?php

namespace App\Filament\Resources;

use App\Enums\Notifications;
use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use Closure;
use CodeWithDennis\FilamentSelectTree\SelectTree;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';
    
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Role Information')
                    ->description(fn($operation) => $operation === 'edit' ? 'Update role\'s basic information here.' : 'Please enter role\'s basic information here.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Role')
                            ->required()
                            ->maxLength(255)
                    ]),
                Forms\Components\Section::make('Choose Modules')
                    ->description('Enable permissions for each module.')
                    ->schema([
                        Repeater::make('modules')
                            ->hiddenLabel()
                            ->relationship('modules')
                            ->itemLabel(fn($state) => $state['name'])
                            ->schema([
                                CheckboxList::make('permissions')
                                    ->hiddenLabel()
                                    ->relationship('permissions', 'name', function (Builder $query, Forms\Get $get, CheckboxList $component) {
                                        $roleId = $get('role_id');
                                        $moduleId = $get('module_id');
                                        $selectedPermissionIds = $component->getModelInstance()->permissions()->where(['permissions.module_id' => $moduleId, 'role_id' => $roleId])->pluck('permissions.id')->toArray();
                                        $component->state($selectedPermissionIds);
                                        return $query->where(['permissions.module_id' => $moduleId]);
                                    })
                                    ->saveRelationshipsUsing(static function (CheckboxList $component, ?array $state, Forms\Get $get) {
                                        $roleId = $get('role_id');
                                        $newState = [];
                                        foreach ($state as $permissionId) {
                                            $newState[$permissionId] =  ['role_id' => $roleId]; 
                                        }
                                        $component->getRelationship()->wherePivot('role_id', $roleId)->sync($newState ?? []);
                                    })
                                    ->bulkToggleable()
                                    ->searchable()
                                    ->columns([
                                        'xl' => 3,
                                        'lg' => 3,
                                        'md' => 3,
                                        'sm' => 2
                                    ])
                            ])
                            ->deletable(false)
                            ->addable(false)
                            ->collapsible()
                    ])->hiddenOn('create')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
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
                    ->action(function (Role $record) {
                        if ($record->users->isNotEmpty()) {
                            Notification::make()
                                ->danger()
                                ->title(Notifications::DEFAULT_FAILED_TITLE)
                                ->body(Notifications::ROLE_DELETE_FAILED_BODY)
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
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
}
