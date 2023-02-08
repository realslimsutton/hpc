<?php

namespace App\Filament\Resources\Club\ClubUpdateResource\RelationManagers;

use App\Filament\Resources\System\UserResource;
use App\Models\Club\ClubRingGame;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RingGamesRelationManager extends RelationManager
{
    protected static string $relationship = 'ring_games';

    protected static ?string $recordTitleAttribute = 'table_name';

    protected static ?string $label = 'Ring Game';

    protected static ?string $pluralLabel = 'Ring Games';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('started_at')
                    ->label('Started at')
                    ->required(),
                Forms\Components\DatePicker::make('ended_at')
                    ->label('Ended at')
                    ->required(),
                Forms\Components\TextInput::make('table_name')
                    ->label('Table name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('user_id')
                    ->label('Created by')
                    ->relationship('user', 'full_name')
                    ->preload()
                    ->searchable()
                    ->nullable(),
                Forms\Components\TextInput::make('game_rules')
                    ->label('Game')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('blinds')
                    ->label('Blinds')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('rake')
                    ->label('Rake')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('rake_cap')
                    ->label('Rake cap')
                    ->nullable()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('ended_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('started_at')
                    ->label('Started at')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ended_at')
                    ->label('Ended at')
                    ->date()
                    ->sortable()
                    ->formatStateUsing(static fn(?string $state): string => $state ?? '-'),
                Tables\Columns\BadgeColumn::make('duration')
                    ->label('Duration')
                    ->sortable()
                    ->getStateUsing(static fn(ClubRingGame $record) => $record->ended_at !== null ? $record->duration : now()->diff($record->started_at)->format('H:i:s')),
                Tables\Columns\TextColumn::make('table_name')
                    ->label('Table name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.full_name')
                    ->label('Created by')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(static fn(?string $state): string => $state ?? '-')
                    ->url(static fn($record) => filled($record->user_id) ? UserResource::getUrl('edit', $record->user_id) : null, true),
                Tables\Columns\BadgeColumn::make('users_count')
                    ->label('Users')
                    ->counts('users')
                    ->sortable()
                    ->color('success'),
                Tables\Columns\TextColumn::make('game_rules')
                    ->label('Game')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('blinds')
                    ->label('Blinds')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(static fn(string $state) => '$' . $state),
                Tables\Columns\TextColumn::make('rake')
                    ->label('Rake')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('rake_cap')
                    ->label('Rake cap')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(static fn(?string $state): string => $state ?? '-')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
