<?php

namespace App\Filament\Resources\Club\ClubUpdateResource\RelationManagers;

use App\Filament\Resources\System\UserResource;
use App\Models\Club\ClubTournament;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TournamentsRelationManager extends RelationManager
{
    protected static string $relationship = 'tournaments';

    protected static ?string $recordTitleAttribute = 'table_name';

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
                Forms\Components\TextInput::make('buy_in')
                    ->label('Buy in')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('gtd_prize')
                    ->label('GTD Prize')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('re_entry')
                    ->label('Re-entry')
                    ->helperText('Is re-entry allowed?'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
                    ->getStateUsing(static fn(ClubTournament $record) => $record->ended_at !== null ? $record->duration : now()->diff($record->started_at)->format('H:i:s')),
                Tables\Columns\TextColumn::make('table_name')
                    ->label('Table name')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
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
                Tables\Columns\TextColumn::make('buy_in')
                    ->label('Buy in')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('gtd_prize')
                    ->label('GTD Prize')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('re_entry')
                    ->label('Re-entry')
                    ->sortable()
                    ->enum([
                        false => 'Disabled',
                        true => 'Enabled'
                    ])
                    ->colors([
                        'danger' => false,
                        'success' => true
                    ])
                    ->icons([
                        'heroicon-o-x' => false,
                        'heroicon-o-check' => true
                    ]),
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
