<?php

namespace App\Filament\Resources\Tracker;

use App\Filament\Resources\Tracker\SessionResource\Pages;
use App\Filament\Resources\Tracker\SessionResource\RelationManagers;
use App\Models\Tracker\Session;
use Closure;
use Filament\Forms;
use Filament\GlobalSearch\Actions\Action;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Unique;

class SessionResource extends Resource
{
    protected static ?string $model = Session::class;

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
                Forms\Components\Card::make()
                    ->columnSpan([
                        'sm' => 2,
                    ])
                    ->columns([
                        'sm' => 2,
                    ])
                    ->schema([
                        Forms\Components\Fieldset::make('Basic information')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\DatePicker::make('date')
                                    ->label('Date')
                                    ->required(),
                            ]),

                        Forms\Components\Fieldset::make('Stream information')
                            ->schema([
                                Forms\Components\Select::make('location_id')
                                    ->label('Location')
                                    ->relationship('location', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->createOptionForm([
                                        Forms\Components\Grid::make()
                                            ->schema([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Name')
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->unique(ignoreRecord: true),
                                            ]),
                                    ]),
                                Forms\Components\TextInput::make('stream_url')
                                    ->label('Stream link')
                                    ->helperText('This should be the embed link')
                                    ->nullable()
                                    ->maxLength(65535),
                            ]),

                        Forms\Components\Fieldset::make('Session information')
                            ->schema([
                                Forms\Components\Select::make('game_rules_id')
                                    ->label('Game rules')
                                    ->relationship('game_rules', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Name')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(),
                                    ]),
                                Forms\Components\Select::make('stake_id')
                                    ->label('Stake')
                                    ->relationship('stake', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('small_blind')
                                            ->label('Small blind')
                                            ->required()
                                            ->integer()
                                            ->minValue(0)
                                            ->maxValue(2147483648)
                                            ->unique(
                                                callback: static function (Unique $rule, Closure $get): Unique {
                                                    return $rule->where('big_blind', $get('big_blind'));
                                                }
                                            )
                                            ->mask(static fn (Forms\Components\TextInput\Mask $mask) => $mask->money(decimalPlaces: 0)),
                                        Forms\Components\TextInput::make('big_blind')
                                            ->label('Big blind')
                                            ->required()
                                            ->integer()
                                            ->minValue(0)
                                            ->maxValue(2147483648)
                                            ->unique(
                                                callback: static function (Unique $rule, Closure $get): Unique {
                                                    return $rule->where('small_blind', $get('small_blind'));
                                                }
                                            )
                                            ->mask(static fn (Forms\Components\TextInput\Mask $mask) => $mask->money(decimalPlaces: 0)),
                                    ]),
                            ]),
                    ]),

                Forms\Components\Card::make()
                    ->columnSpan(1)
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(static fn (?Session $record): string => $record?->created_at?->diffForHumans() ?? '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Updated at')
                            ->content(static fn (?Session $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('date', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('location.name')
                    ->label('Location')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('game_rules.name')
                    ->label('Game rules')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stake.name')
                    ->label('Stake')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('players_count')
                    ->label('Players')
                    ->counts('players')
                    ->color('success'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created at')
                    ->date()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated at')
                    ->date()
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListSessions::route('/'),
            'create' => Pages\CreateSession::route('/create'),
            'edit' => Pages\EditSession::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'name',
            'date',
        ];
    }

    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->name;
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Date' => $record->date->format('M j, Y'),
            'Location' => $record->location->name,
        ];
    }

    protected static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()
            ->with([
                'location',
            ]);
    }

    public static function getGlobalSearchResultActions(Model $record): array
    {
        return [
            Action::make('view-stream')
                ->label('View stream')
                ->url($record->stream_url)
                ->hidden(blank($record->stream_url)),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        return number_format(Session::query()->count());
    }
}
