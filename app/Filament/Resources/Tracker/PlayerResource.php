<?php

namespace App\Filament\Resources\Tracker;

use App\Filament\Resources\Tracker\PlayerResource\Pages;
use App\Models\Tracker\Player;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Squire\Models\Country;
use function parse_url;
use function today;

class PlayerResource extends Resource
{
    protected static ?string $model = Player::class;

    protected static ?string $slug = 'tracker/players';

    protected static ?string $navigationGroup = 'Tracker';

    protected static ?string $navigationLabel = 'Players';

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->columns([
                'sm' => 3,
                'lg' => null,
            ])
            ->schema([
                Forms\Components\Grid::make()
                    ->columnSpan([
                        'sm' => 2,
                    ])
                    ->schema([
                        Forms\Components\Section::make('Identity')
                            ->columns([
                                'sm' => 2,
                            ])
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

                        Forms\Components\Section::make('Location')
                            ->columns([
                                'sm' => 2,
                            ])
                            ->schema([
                                Forms\Components\Select::make('country_id')
                                    ->label('Country')
                                    ->options(Country::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->nullable(),
                                Forms\Components\TextInput::make('hometown')
                                    ->label('Hometown')
                                    ->nullable()
                                    ->maxLength(255),
                            ]),

                        Forms\Components\Section::make('Social')
                            ->columns([
                                'sm' => 2,
                            ])
                            ->schema([
                                Forms\Components\TextInput::make('twitter_url')
                                    ->label('Twitter link')
                                    ->nullable()
                                    ->maxLength(65535)
                                    ->requiredWith('twitter_handle')
                                    ->debounce()
                                    ->afterStateUpdated(static function (Closure $set, Closure $get): void {
                                        if (filled($get('twitter_handle')) || !$url = parse_url($get('twitter_url'))) {
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
                    ]),

                Forms\Components\Grid::make()
                    ->columnSpan(1)
                    ->schema([
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Toggle::make('enabled')
                                    ->label('Enabled')
                                    ->helperText('Disabling this player will remove them from all rankings'),
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(static fn(?Player $record): string => $record?->created_at?->diffForHumans() ?? '-'),
                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Updated at')
                                    ->content(static fn(?Player $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
                            ]),
                        Forms\Components\Card::make()
                            ->schema([
                                CuratorPicker::make('featured_image_id')
                                    ->label('Featured image')
                                    ->acceptedFileTypes([
                                        'image/jpeg',
                                        'image/png',
                                        'image/webp',
                                        'image/svg+xml',
                                    ]),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('updated_at', 'desc')
            ->columns([
                CuratorColumn::make('featured_image')
                    ->label('Featured image')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nickname')
                    ->label('Nickname')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(static fn(?string $state): string => $state ?? '-'),
                Tables\Columns\TextColumn::make('twitter_handle')
                    ->label('Twitter')
                    ->url(static fn(Player $record): ?string => $record->twitter_url, true)
                    ->formatStateUsing(static fn(?string $state): string => $state ?? '-'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlayers::route('/'),
            'create' => Pages\CreatePlayer::route('/create'),
            'edit' => Pages\EditPlayer::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with([
                'featured_image',
            ]);
    }
}
