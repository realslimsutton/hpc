<?php

namespace App\Filament\Resources\Tracker\ProfessionalSessionResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class PlayersRelationManager extends RelationManager
{
    protected static string $relationship = 'players';

    protected static ?string $inverseRelationship = 'sessions';

    protected static ?string $recordTitleAttribute = 'name';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('pivot.net_winnings')
                    ->label('Net winnings')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(static fn($record, $state) => '$' . number_format($state, 2)),
                Tables\Columns\TextColumn::make('pivot.vpip')
                    ->label('VPIP (%)')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(static fn($state) => number_format($state, 2) . '%'),
                Tables\Columns\TextColumn::make('pivot.pfr')
                    ->label('PFR (%)')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(static fn($state) => number_format($state, 2) . '%'),
                Tables\Columns\TextColumn::make('hours_played')
                    ->label('Hours played')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(static fn($state) => number_format($state, 1))
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(static fn(Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\TextInput::make('net_winnings')
                            ->label('Net winnings')
                            ->required()
                            ->numeric()
                            ->afterStateHydrated(static fn($component, $state) => $state !== null ? $component->state($state / 100) : null)
                            ->mask(static fn(Forms\Components\TextInput\Mask $mask) => $mask->money()),
                        Forms\Components\TextInput::make('vpip')
                            ->label('VPIP (%)')
                            ->required()
                            ->numeric()
                            ->afterStateHydrated(static fn($component, $state) => $state !== null ? $component->state($state * 100) : null),
                        Forms\Components\TextInput::make('pfr')
                            ->label('PFR (%)')
                            ->required()
                            ->numeric()
                            ->afterStateHydrated(static fn($component, $state) => $state !== null ? $component->state($state * 100) : null),
                        Forms\Components\TextInput::make('hours_played')
                            ->label('Hours played')
                            ->required()
                            ->numeric()
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Player information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Checkbox::make('enabled')
                            ->label('Enabled')
                            ->default(true)
                            ->helperText('If disabled, the player will not be viewable within the tracker')
                    ]),
                Forms\Components\Fieldset::make('Session information')
                    ->schema([
                        Forms\Components\TextInput::make('net_winnings')
                            ->label('Net winnings')
                            ->required()
                            ->numeric()
                            ->afterStateHydrated(static fn($component, $state) => $state !== null ? $component->state($state / 100) : null)
                            ->mask(static fn(Forms\Components\TextInput\Mask $mask) => $mask->money()),
                        Forms\Components\TextInput::make('vpip')
                            ->label('VPIP (%)')
                            ->required()
                            ->numeric()
                            ->afterStateHydrated(static fn($component, $state) => $state !== null ? $component->state($state * 100) : null),
                        Forms\Components\TextInput::make('pfr')
                            ->label('PFR (%)')
                            ->required()
                            ->numeric()
                            ->afterStateHydrated(static fn($component, $state) => $state !== null ? $component->state($state * 100) : null),
                        Forms\Components\TextInput::make('hours_played')
                            ->label('Hours played')
                            ->required()
                            ->numeric()
                    ])
            ]);
    }
}
