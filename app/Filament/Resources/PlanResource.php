<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanResource\Pages;
use App\Filament\Resources\PlanResource\RelationManagers;
use App\Models\Plan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Enums\UserRole;
use Filament\Forms\Components\Section;
use Filament\Tables\Filters\Filter;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-cursor-arrow-ripple';
    
    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Plan Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->placeholder('Plan Name')
                            ->helperText('Unique Plan name')
                            ->reactive()
                            ->afterStateUpdated(fn($state, callable $set) => 
                                $set('name', strtoupper($state))
                            )
                            ->disableAutocomplete()
                            ->maxLength(100)
                            ->required()
                            ->unique(ignoreRecord:true),
                        Forms\Components\Textarea::make('description')
                            ->placeholder('Plan Description')
                            ->label('Description')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('price')
                            ->label('Price')
                            ->helperText('Price in $')
                            ->default(0.00)
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('points_per_month')
                            ->label('Points per Month')
                            ->helperText('Number of API Request per Month')
                            ->default(200)
                            ->minValue(200)
                            ->maxValue(9999999)
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('request_per_second')
                            ->label('Request per Second')
                            ->helperText('Number of Request per Second')
                            ->numeric()
                            ->required()
                            ->default(7)
                            ->maxValue(100),                       

                    ])
                    ->columns(2)
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Plan Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn ($record) => "$ {$record->price}" ?: '-'),
                Tables\Columns\TextColumn::make('points_per_month')
                    ->label('Points/Month')
                    ->formatStateUsing(fn ($record) => number_format($record->points_per_month))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('request_per_second')
                    ->label('Request/Second')
                    ->formatStateUsing(fn ($record) => number_format($record->request_per_second))
                    ->searchable()
                    ->sortable(),
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
                Tables\Actions\EditAction::make(),
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

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'description'];
    }

    public static function getGlobalSearchResultDetails($record): array
    {
        return [
            'Description' => $record->description,
            'Price' => $record->price,
        ];
    }

    public static function canAccess(): bool
    {
        return in_array(auth()->user()->role, [UserRole::Admin, UserRole::Superadmin]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlans::route('/'),
            'create' => Pages\CreatePlan::route('/create'),
            'edit' => Pages\EditPlan::route('/{record}/edit'),
        ];
    }
}
