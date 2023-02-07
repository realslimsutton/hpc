<?php

namespace App\Filament\Resources\Club\ClubUpdateResource\RelationManagers;

use Akaunting\Money\Money;
use App\Filament\Resources\System\UserResource;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OverviewRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    protected static ?string $recordTitleAttribute = 'user_id';

    protected static ?string $label = 'Overview';

    protected static ?string $title = 'Overview';

    protected static ?string $pluralLabel = 'Overviews';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'full_name')
                    ->preload()
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('agent_id')
                    ->label('Agent')
                    ->relationship('agent', 'full_name')
                    ->preload()
                    ->searchable()
                    ->nullable(),
                Forms\Components\TextInput::make('games')
                    ->label('Games')
                    ->integer()
                    ->required()
                    ->minValue(0)
                    ->maxValue(2147483647),
                Forms\Components\TextInput::make('hands')
                    ->label('Hands')
                    ->integer()
                    ->required()
                    ->minValue(0)
                    ->maxValue(2147483647),
                Forms\Components\TextInput::make('fee')
                    ->label('Fee')
                    ->mask(static fn(Forms\Components\TextInput\Mask $mask) => $mask->money())
                    ->afterStateHydrated(static fn($component, $state) => $component->state($state / 100))
                    ->dehydrateStateUsing(static fn($state) => $state * 100)
                    ->required()
                    ->maxValue(18446744073709551615),
                Forms\Components\TextInput::make('insurance')
                    ->label('Insurance')
                    ->mask(static fn(Forms\Components\TextInput\Mask $mask) => $mask->money())
                    ->afterStateHydrated(static fn($component, $state) => $component->state($state / 100))
                    ->dehydrateStateUsing(static fn($state) => $state * 100)
                    ->required()
                    ->maxValue(18446744073709551615),
                Forms\Components\TextInput::make('net_winnings')
                    ->label('Net winnings')
                    ->mask(static fn(Forms\Components\TextInput\Mask $mask) => $mask->money())
                    ->afterStateHydrated(static fn($component, $state) => $component->state($state / 100))
                    ->dehydrateStateUsing(static fn($state) => $state * 100)
                    ->required()
                    ->maxValue(18446744073709551615)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.clubgg_id')
                    ->label('ID')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.nickname')
                    ->label('Nickname')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(static fn(?string $state): string => $state ?? '-'),
                Tables\Columns\TextColumn::make('agent.clubgg_id')
                    ->label('Agent ID')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(static fn(?string $state): string => $state ?? '-')
                    ->url(static fn($record) => filled($record->agent_id) ? UserResource::getUrl('edit', $record->agent_id) : null, true),
                Tables\Columns\TextColumn::make('agent.nickname')
                    ->label('Agent Nickname')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(static fn(?string $state): string => $state ?? '-')
                    ->url(static fn($record) => filled($record->agent_id) ? UserResource::getUrl('edit', $record->agent_id) : null, true),
                Tables\Columns\TextColumn::make('games')
                    ->label('Games')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(static fn($state) => number_format($state)),
                Tables\Columns\TextColumn::make('hands')
                    ->label('Hands')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(static fn($state) => number_format($state)),
                Tables\Columns\TextColumn::make('fee')
                    ->label('Fee')
                    ->sortable()
                    ->formatStateUsing(static fn($state) => Money::USD($state)),
                Tables\Columns\TextColumn::make('insurance')
                    ->label('Insurance')
                    ->sortable()
                    ->formatStateUsing(static fn($state) => Money::USD($state)),
                Tables\Columns\TextColumn::make('net_winnings')
                    ->label('Net winnings')
                    ->sortable()
                    ->formatStateUsing(static fn($state) => Money::USD($state)),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading('Edit overview'),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\DeleteAction::make()
                        ->modalHeading('Delete overview'),
                ])
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
