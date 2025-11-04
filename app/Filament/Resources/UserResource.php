<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Enums\UserRole;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Section;
use Filament\Notifications\Notification;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 1;

    protected static ?string $label = "User Management";

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('User Information')
                    ->description('Enter User Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->placeholder('User Fullname')
                            ->required()
                            ->disableAutocomplete()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                        ->label('Email Address')
                            ->required()
                            ->placeholder('user@domain.com')
                            ->maxLength(255)
                            ->email()
                            ->disableAutocomplete(),
                        Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->placeholder('********')
                            ->minLength(8)
                            ->maxLength(255)
                            ->helperText('At least 8 character password.')
                            ->required()
                            ->revealable()
                            ->password(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('userPlan.plan.name'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->label('Status'),
            ])
            ->filters([
                Filter::make('is_active')
                    ->label('Active Only')
                    ->query(fn (Builder $query): Builder => $query->where('is_active', true))
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('mark_inactive')
                        ->label(fn (User $user) => "Mark {$user->name} Inactive")
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->visible(fn (User $user) => $user->is_active === true)
                        ->requiresConfirmation()
                        ->action(function (User $user) {
                            $user->is_active = false;
                            $user->save();

                            Notification::make()
                                ->success()
                                ->title('User marked as inactive.')
                                ->body("{$user->name} been successfully marked as inactive.")
                                ->send();
                        }),
                    Tables\Actions\Action::make('mark_active')
                        ->label(fn (User $user) => "Mark {$user->name} Active")
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->visible(fn (User $user) => $user->is_active === false)
                        ->requiresConfirmation()
                        ->action(function (User $user) {
                            $user->is_active = true;
                            $user->save();

                            Notification::make()
                                ->success()
                                ->title('User marked as active.')
                                ->body("{$user->name} been successfully marked as active.")
                                ->send();
                        }),
                    Tables\Actions\Action::make('reset_password')
                        ->label('Reset password')
                        ->icon('heroicon-o-key')
                        ->color('warning')
                        ->modalDescription(fn (User $user) => "Reset password for {$user->name}")
                        ->form([
                            Forms\Components\TextInput::make('password')
                                ->password()
                                ->revealable()
                                ->label('Password')
                                ->helperText('At least 8 Characters')
                                ->minLength(8)
                                ->maxLength(255)
                        ])
                        ->action(function (array $data, User $user) {
                            $user->password = bcrypt($data['password']);
                            $user->save();

                            Notification::make()
                                ->success()
                                ->title("Password Succesfully Reset!")
                                ->body("Password for {$user->name} is sucessfully reset!")
                                ->send();
                        }),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }

    public static function getGlobalSearchResultDetails($record): array
    {
        return [
            'Email' => $record->email,
        ];
    }


    public static function canAccess(): bool
    {
        return in_array(auth()->user()->role, [UserRole::Admin, UserRole::Superadmin]);
    }


    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('role', 'user');
    }
}
