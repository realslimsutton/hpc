<?php

namespace App\Filament\Resources\Tracker;

use App\Filament\Resources\Tracker\ProfessionalPlayerResource\Pages;
use App\Models\Tracker\ProfessionalPlayer;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Squire\Models\Country;

class ProfessionalPlayerResource extends Resource
{
    protected static ?string $model = ProfessionalPlayer::class;

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
                                Forms\Components\TextInput::make('name')
                                    ->label('Name')
                                    ->required()
                                    ->maxLength(255),
                                CuratorPicker::make('featured_image_id')
                                    ->label('Featured image'),
                                Forms\Components\MarkdownEditor::make('biography')
                                    ->label('Biography')
                                    ->columnSpanFull()
                                    ->required()
                                    ->maxLength(65535),
                                Forms\Components\Select::make('country')
                                    ->label('Country')
                                    ->options(Country::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->nullable(),
                                Forms\Components\TextInput::make('hometown')
                                    ->label('Hometown')
                                    ->nullable()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('twitter_url')
                                    ->label('Twitter URL')
                                    ->nullable()
                                    ->requiredWith('twitter_handle')
                                    ->maxLength(65535),
                                Forms\Components\TextInput::make('twitter_handle')
                                    ->label('Twitter handle')
                                    ->nullable()
                                    ->requiredWith('twitter_url')
                                    ->maxLength(255),
                                Forms\Components\DatePicker::make('date_of_birth')
                                    ->label('Date of birth')
                                    ->nullable()
                                    ->maxDate(now())
                            ]),
                    ]),

                Forms\Components\Card::make()
                    ->columnSpan(1)
                    ->schema([
                        Forms\Components\Checkbox::make('enabled')
                            ->label('Enabled')
                            ->default(true)
                            ->helperText('If disabled, the player will not be viewable within the tracker'),
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(static fn(?ProfessionalPlayer $record): string => $record?->created_at?->diffForHumans() ?? '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Updated at')
                            ->content(static fn(?ProfessionalPlayer $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
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
                Tables\Columns\BadgeColumn::make('enabled')
                    ->label('Status')
                    ->enum([
                        true => 'Enabled',
                        false => 'Disabled',
                    ])
                    ->colors([
                        'success' => true,
                        'danger' => false,
                    ])
                    ->icons([
                        'heroicon-o-check' => true,
                        'heroicon-o-x' => false,
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created at')
                    ->sortable()
                    ->date(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated at')
                    ->sortable()
                    ->date(),
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
            'index' => Pages\ListProfessionalPlayers::route('/'),
            'create' => Pages\CreateProfessionalPlayer::route('/create'),
            'edit' => Pages\EditProfessionalPlayer::route('/{record}/edit'),
        ];
    }
}
