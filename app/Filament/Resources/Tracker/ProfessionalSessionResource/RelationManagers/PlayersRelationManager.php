<?php

namespace App\Filament\Resources\Tracker\ProfessionalSessionResource\RelationManagers;

use Akaunting\Money\Money;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Squire\Models\Country;

class PlayersRelationManager extends RelationManager
{
    protected static string $relationship = 'players';

    protected static ?string $inverseRelationship = 'professional_sessions';

    protected static ?string $recordTitleAttribute = 'name';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),
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
                    ->maxDate(now()),
                Forms\Components\TextInput::make('nickname')
                    ->label('Nickname')
                    ->nullable()
                    ->maxLength(255),
                Forms\Components\TextInput::make('profession')
                    ->label('Profession')
                    ->nullable()
                    ->maxLength(255)
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(static fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\TextInput::make('net_winnings')
                            ->label('Net winnings')
                            ->required()
                            ->numeric()
                            ->afterStateHydrated(static fn ($component, $state) => $state !== null ? $component->state($state / 100) : null)
                            ->mask(static fn (Forms\Components\TextInput\Mask $mask) => $mask->money()),
                        Forms\Components\TextInput::make('vpip')
                            ->label('VPIP (%)')
                            ->required()
                            ->numeric()
                            ->afterStateHydrated(static fn ($component, $state) => $state !== null ? $component->state($state * 100) : null),
                        Forms\Components\TextInput::make('pfr')
                            ->label('PFR (%)')
                            ->required()
                            ->numeric()
                            ->afterStateHydrated(static fn ($component, $state) => $state !== null ? $component->state($state * 100) : null),
                        Forms\Components\TextInput::make('hours_played')
                            ->label('Hours played')
                            ->required()
                            ->numeric(),
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
                    ->maxDate(now()),
                Forms\Components\TextInput::make('nickname')
                    ->label('Nickname')
                    ->nullable()
                    ->maxLength(255),
                Forms\Components\TextInput::make('profession')
                    ->label('Profession')
                    ->nullable()
                    ->maxLength(255)
            ]);
    }
}
