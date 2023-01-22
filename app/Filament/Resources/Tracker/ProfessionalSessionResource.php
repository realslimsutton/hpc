<?php

namespace App\Filament\Resources\Tracker;

use App\Filament\Resources\Tracker\ProfessionalSessionResource\Pages;
use App\Filament\Resources\Tracker\ProfessionalSessionResource\RelationManagers;
use App\Models\Tracker\ProfessionalSession;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ProfessionalSessionResource extends Resource
{
    protected static ?string $model = ProfessionalSession::class;

    protected static ?string $slug = 'tracker/sessions';

    protected static ?string $navigationGroup = 'Tracker';

    protected static ?string $navigationLabel = 'Sessions';

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->columns([
                'sm' => 3,
                'lg' => null,
            ])
            ->schema([
                Forms\Components\Grid::make()
                    ->columns([
                        'sm' => 2,
                    ])
                    ->columnSpan([
                        'sm' => 2,
                    ])
                    ->schema([
                        Forms\Components\Card::make()
                            ->columns()
                            ->schema([
                                Forms\Components\Select::make('location_id')
                                    ->label('Location')
                                    ->relationship('location', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(static function (Closure $set, Closure $get, ?int $state) {
                                        if ($state === null || filled($get('name'))) {
                                            return;
                                        }

                                        $set(
                                            'name',
                                            'Episode '.ProfessionalSession::query()
                                                ->where('location_id', '=', $state)
                                                ->count() + 1
                                        );
                                    })
                                    ->createOptionForm([
                                        Forms\Components\Grid::make()
                                            ->schema([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Name')
                                                    ->required()
                                                    ->maxLength(255),
                                            ]),
                                    ]),
                                Forms\Components\Select::make('poker_game_id')
                                    ->label('Game played')
                                    ->relationship('poker_game', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->required()
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Name')
                                            ->required()
                                            ->maxLength(255),
                                    ]),
                                Forms\Components\TextInput::make('name')
                                    ->label('Name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\DatePicker::make('date')
                                    ->label('Date')
                                    ->required(),
                                Forms\Components\TextInput::make('stream_url')
                                    ->label('Stream URL')
                                    ->required()
                                    ->helperText('This should be the embed URL')
                                    ->maxLength(65535),
                                Forms\Components\Select::make('stake_id')
                                    ->relationship('stake', 'name')
                                    ->required()
                                    ->createOptionForm([
                                        Forms\Components\Grid::make()
                                            ->schema([
                                                Forms\Components\TextInput::make('small_blind')
                                                    ->label('Small blind')
                                                    ->integer()
                                                    ->required()
                                                    ->minValue(1),
                                                Forms\Components\TextInput::make('big_blind')
                                                    ->label('Big blind')
                                                    ->integer()
                                                    ->required()
                                                    ->minValue(1),
                                            ]),
                                    ]),
                            ]),
                    ]),

                Forms\Components\Card::make()
                    ->columnSpan(1)
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(static fn (?ProfessionalSession $record): string => $record?->created_at?->diffForHumans() ?? '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Updated at')
                            ->content(static fn (?ProfessionalSession $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location.name')
                    ->label('Location')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('poker_game.name')
                    ->label('Game')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('stake.name')
                    ->label('Stake')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('players_count')
                    ->label('Players')
                    ->counts('players')
                    ->color('success')
                    ->sortable()
                    ->formatStateUsing(static fn ($state) => number_format($state)),
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
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PlayersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfessionalSessions::route('/'),
            'create' => Pages\CreateProfessionalSession::route('/create'),
            'edit' => Pages\EditProfessionalSession::route('/{record}/edit'),
        ];
    }
}
