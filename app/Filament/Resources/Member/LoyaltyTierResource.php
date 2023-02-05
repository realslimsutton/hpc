<?php

namespace App\Filament\Resources\Member;

use App\Filament\Resources\Member\LoyaltyTierResource\Pages;
use App\Models\Member\LoyaltyTier;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use function number_format;

class LoyaltyTierResource extends Resource
{
    protected static ?string $model = LoyaltyTier::class;

    protected static ?string $navigationGroup = 'Loyalty Program';

    protected static ?string $navigationIcon = 'heroicon-o-gift';

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
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('lp_requirement')
                            ->label('LP Requirement')
                            ->required()
                            ->mask(static fn (Forms\Components\TextInput\Mask $mask) => $mask
                                ->money(prefix: '', decimalPlaces: 0, isSigned: false)
                                ->minValue(0)
                                ->maxValue(18446744073709551615)
                            )
                            ->suffix('LP')
                            ->minValue(0)
                            ->maxValue(18446744073709551615),
                    ]),

                Forms\Components\Grid::make()
                    ->columnSpan(1)
                    ->schema([
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(static fn (?LoyaltyTier $record): string => $record?->created_at?->diffForHumans() ?? '-'),
                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Updated at')
                                    ->content(static fn (?LoyaltyTier $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
                            ]),
                        Forms\Components\Card::make()
                            ->schema([
                                CuratorPicker::make('featured_image_id')
                                    ->disableLabel()
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
            ->defaultSort('lp_requirement')
            ->columns([
                CuratorColumn::make('featured_image')
                    ->label('Featured image')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('lp_requirement')
                    ->label('LP Requirement')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(static fn (int $state) => number_format($state)),
                Tables\Columns\BadgeColumn::make('users_count')
                    ->label('Members')
                    ->counts('users')
                    ->color('success'),
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
                    Tables\Actions\DeleteAction::make(),
                ]),
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
            'index' => Pages\ListLoyaltyTiers::route('/'),
            'create' => Pages\CreateLoyaltyTier::route('/create'),
            'edit' => Pages\EditLoyaltyTier::route('/{record}/edit'),
        ];
    }
}
