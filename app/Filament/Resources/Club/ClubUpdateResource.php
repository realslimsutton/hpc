<?php

namespace App\Filament\Resources\Club;

use App\Filament\Resources\Club\ClubUpdateResource\Pages;
use App\Filament\Resources\Club\ClubUpdateResource\RelationManagers\OverviewRelationManager;
use App\Filament\Resources\Club\ClubUpdateResource\RelationManagers\RingGamesRelationManager;
use App\Filament\Resources\Club\ClubUpdateResource\RelationManagers\TournamentsRelationManager;
use App\Filament\Resources\System\UserResource;
use App\Models\Club\ClubUpdate;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ClubUpdateResource extends Resource
{
    protected static ?string $model = ClubUpdate::class;

    protected static ?string $navigationGroup = 'Club';

    protected static ?string $navigationIcon = 'heroicon-o-cloud-upload';

    public static function form(Form $form): Form
    {
        return $form
            ->columns([
                'sm' => 3,
                'lg' => null,
            ])
            ->schema([
                Forms\Components\Card::make()
                    ->columnSpan([
                        'sm' => 2,
                    ])
                    ->columns([
                        'sm' => 2,
                    ])
                    ->schema([
                        Forms\Components\DatePicker::make('date')
                            ->label('Date')
                            ->required(),
                        Forms\Components\Select::make('user_id')
                            ->label('Created by')
                            ->relationship('user', 'full_name')
                            ->preload()
                            ->searchable()
                            ->nullable()
                    ]),

                Forms\Components\Card::make()
                    ->columnSpan(1)
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(static fn(?ClubUpdate $record): string => $record?->created_at?->diffForHumans() ?? '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Updated at')
                            ->content(static fn(?ClubUpdate $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('date', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('ring_games_count')
                    ->label('Ring games')
                    ->counts('ring_games')
                    ->sortable()
                    ->color('success'),
                Tables\Columns\BadgeColumn::make('tournaments_count')
                    ->label('Tournaments')
                    ->counts('tournaments')
                    ->sortable()
                    ->color('success'),
                Tables\Columns\TextColumn::make('user.full_name')
                    ->label('Created by')
                    ->formatStateUsing(static fn(?string $state): string => $state ?? '-')
                    ->searchable()
                    ->url(static fn($record) => filled($record->user_id) ? UserResource::getUrl('edit', $record->user_id) : null, true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created at')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated at')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\DeleteAction::make()
                ])
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            OverviewRelationManager::class,
            RingGamesRelationManager::class,
            TournamentsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClubUpdates::route('/'),
            'create' => Pages\CreateClubUpdate::route('/create'),
            'edit' => Pages\EditClubUpdate::route('/{record}/edit'),
        ];
    }
}
