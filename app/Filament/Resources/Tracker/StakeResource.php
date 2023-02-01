<?php

namespace App\Filament\Resources\Tracker;

use App\Filament\Resources\Tracker\StakeResource\Pages;
use App\Models\Tracker\Stake;
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

class StakeResource extends Resource
{
    protected static ?string $model = Stake::class;

    protected static ?string $slug = 'tracker/stakes';

    protected static ?string $navigationGroup = 'Tracker';

    protected static ?string $navigationLabel = 'Stakes';

    protected static ?string $navigationIcon = 'heroicon-o-cash';

    protected static ?int $navigationSort = 4;

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
                        Forms\Components\TextInput::make('small_blind')
                            ->label('Small blind')
                            ->required()
                            ->integer()
                            ->minValue(0)
                            ->maxValue(2147483648)
                            ->unique(
                                callback: static function (Unique $rule, Closure $get): Unique {
                                    return $rule->where('big_blind', $get('big_blind'));
                                },
                                ignoreRecord: true
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
                                },
                                ignoreRecord: true
                            )
                            ->mask(static fn (Forms\Components\TextInput\Mask $mask) => $mask->money(decimalPlaces: 0)),
                    ]),

                Forms\Components\Card::make()
                    ->columnSpan(1)
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(static fn (?Stake $record): string => $record?->created_at?->diffForHumans() ?? '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Updated at')
                            ->content(static fn (?Stake $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('updated_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListStakes::route('/'),
            'create' => Pages\CreateStake::route('/create'),
            'edit' => Pages\EditStake::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'name',
            'small_blind',
            'big_blind'
        ];
    }

    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->name;
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Small blind' => $record->small_blind,
            'Big blind' => $record->big_blind
        ];
    }
}
