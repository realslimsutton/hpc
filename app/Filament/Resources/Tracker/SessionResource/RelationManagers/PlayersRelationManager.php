<?php

namespace App\Filament\Resources\Tracker\SessionResource\RelationManagers;

use Akaunting\Money\Money;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Str;

class PlayersRelationManager extends RelationManager
{
    protected static string $relationship = 'players';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Identity information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nickname')
                            ->label('Nickname')
                            ->nullable()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('date_of_birth')
                            ->label('Date of birth')
                            ->nullable()
                            ->maxDate(today()),
                        Forms\Components\TextInput::make('profession')
                            ->label('Profession')
                            ->nullable()
                            ->maxLength(255),
                        Forms\Components\MarkdownEditor::make('biography')
                            ->label('Biography')
                            ->columnSpanFull()
                            ->nullable()
                            ->maxLength(65535),
                    ]),

                Forms\Components\Fieldset::make('Location information')
                    ->schema([
                        Forms\Components\Select::make('country_id')
                            ->label('Country')
                            ->searchable()
                            ->preload()
                            ->relationship('country', 'name')
                            ->nullable(),
                        Forms\Components\TextInput::make('hometown')
                            ->label('Hometown')
                            ->nullable()
                            ->maxLength(255),
                    ]),

                Forms\Components\Fieldset::make('Social information')
                    ->schema([
                        Forms\Components\TextInput::make('twitter_url')
                            ->label('Twitter link')
                            ->nullable()
                            ->maxLength(65535)
                            ->requiredWith('twitter_handle')
                            ->debounce()
                            ->afterStateUpdated(static function (Closure $set, Closure $get): void {
                                if (filled($get('twitter_handle')) || ! $url = parse_url($get('twitter_url'))) {
                                    return;
                                }

                                $handle = Str::afterLast($url['path'] ?? '', '/');

                                $set('twitter_handle', $handle);
                            }),
                        Forms\Components\TextInput::make('twitter_handle')
                            ->label('Twitter handle')
                            ->prefix('@')
                            ->nullable()
                            ->maxLength(255)
                            ->requiredWith('twitter_url'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('name')
            ->columns([
                CuratorColumn::make('featured_image')
                    ->label('Featured image')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('net_winnings')
                    ->label('Net winnings')
                    ->formatStateUsing(static fn (?int $state) => filled($state) ? Money::USD($state) : '-'),
                Tables\Columns\TextColumn::make('vpip')
                    ->label('VPIP (%)')
                    ->formatStateUsing(static fn (?int $state) => filled($state) ? number_format($state, 2).'%' : '-'),
                Tables\Columns\TextColumn::make('pfr')
                    ->label('PFR (%)')
                    ->formatStateUsing(static fn (?int $state) => filled($state) ? number_format($state, 2).'%' : '-'),
                Tables\Columns\TextColumn::make('hours_played')
                    ->label('Hours played')
                    ->formatStateUsing(static fn (?int $state) => filled($state) ? number_format($state, 2) : '-'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(static fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect()
                            ->label('Player')
                            ->disableLabel(false),
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('net_winnings')
                                    ->label('Net winnings')
                                    ->numeric()
                                    ->nullable()
                                    ->minValue(-2147483648)
                                    ->maxValue(2147483647)
                                    ->dehydrateStateUsing(static fn (?int $state): ?int => filled($state) ? $state * 100 : null),
                                Forms\Components\TextInput::make('hours_played')
                                    ->label('Hours played')
                                    ->numeric()
                                    ->nullable()
                                    ->minValue(-999999.99)
                                    ->maxValue(999999.99),
                                Forms\Components\TextInput::make('vpip')
                                    ->label('VPIP')
                                    ->suffix('%')
                                    ->numeric()
                                    ->nullable()
                                    ->minValue(-999999.99)
                                    ->maxValue(999999.99),
                                Forms\Components\TextInput::make('pfr')
                                    ->label('PFR')
                                    ->suffix('%')
                                    ->numeric()
                                    ->nullable()
                                    ->minValue(-999999.99)
                                    ->maxValue(999999.99),
                            ]),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->form(static fn (Tables\Actions\EditAction $action): array => [
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('net_winnings')
                                    ->label('Net winnings')
                                    ->numeric()
                                    ->nullable()
                                    ->minValue(-2147483648)
                                    ->maxValue(2147483647)
                                    ->afterStateHydrated(static fn ($component, ?int $state) => $component->state(filled($state) ? $state / 100 : null))
                                    ->dehydrateStateUsing(static fn (?int $state): ?int => filled($state) ? $state * 100 : null),
                                Forms\Components\TextInput::make('hours_played')
                                    ->label('Hours played')
                                    ->numeric()
                                    ->nullable()
                                    ->minValue(-999999.99)
                                    ->maxValue(999999.99),
                                Forms\Components\TextInput::make('vpip')
                                    ->label('VPIP')
                                    ->suffix('%')
                                    ->numeric()
                                    ->nullable()
                                    ->minValue(-999999.99)
                                    ->maxValue(999999.99),
                                Forms\Components\TextInput::make('pfr')
                                    ->label('PFR')
                                    ->suffix('%')
                                    ->numeric()
                                    ->nullable()
                                    ->minValue(-999999.99)
                                    ->maxValue(999999.99),
                            ]),
                    ]),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\DetachAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }

    protected function getTableQuery(): Builder|Relation
    {
        return parent::getTableQuery()
            ->with([
                'featured_image',
            ]);
    }
}
