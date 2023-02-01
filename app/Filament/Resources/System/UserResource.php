<?php

namespace App\Filament\Resources\System;

use App\Filament\Resources\System\UserResource\Pages;
use App\Models\User;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Squire\Models\Country;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $slug = 'system/users';

    protected static ?string $navigationGroup = 'System';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

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
                            ->schema([
                                Forms\Components\Fieldset::make('Identity')
                                    ->schema([
                                        Forms\Components\TextInput::make('first_name')
                                            ->label('First name')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('last_name')
                                            ->label('Last name')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('email')
                                            ->label('Email address')
                                            ->required()
                                            ->email()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true),
                                        Forms\Components\Checkbox::make('email_verified_at')
                                            ->label('Email verified')
                                            ->afterStateHydrated(static fn ($component, $state) => $component->state($state !== null))
                                            ->dehydrateStateUsing(static function (?User $record, bool $state) {
                                                if (! $state) {
                                                    return null;
                                                }

                                                return $record?->email_verified_at ?? now();
                                            })
                                            ->helperText('If disabled, the user will be required to verify their email address after logging in.'),
                                        Forms\Components\DatePicker::make('date_of_birth')
                                            ->label('Date of birth')
                                            ->required()
                                            ->maxDate(now()->subYears(18)),
                                        Forms\Components\TextInput::make('phone_number')
                                            ->label('Phone number')
                                            ->required()
                                            ->tel()
                                            ->unique(ignoreRecord: true),
                                        Forms\Components\Select::make('country_id')
                                            ->label('Country')
                                            ->options(Country::all()->pluck('name', 'id'))
                                            ->searchable()
                                            ->required(),
                                        Forms\Components\Checkbox::make('accepts_marketing')
                                            ->label('Agrees to receive marketing emails'),
                                    ]),

                                Forms\Components\Fieldset::make('Password')
                                    ->schema([
                                        Forms\Components\TextInput::make('password')
                                            ->label('Password')
                                            ->password()
                                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                                            ->dehydrated(fn ($state) => filled($state))
                                            ->required(fn (string $context): bool => $context === 'create')
                                            ->confirmed(),
                                        Forms\Components\TextInput::make('password_confirmation')
                                            ->label('Confirm password')
                                            ->password(),
                                    ]),
                            ]),
                    ]),

                Forms\Components\Grid::make()
                    ->columnSpan(1)
                    ->columns([
                        'default' => 1,
                        'lg' => null,
                    ])
                    ->schema([
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Placeholder::make('discord_name')
                                    ->label('Discord name')
                                    ->content(static fn (?User $record): string => $record?->discord_id !== null ? $record->discord_name : '-'),
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(static fn (?User $record): string => $record?->created_at?->diffForHumans() ?? '-'),
                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Updated at')
                                    ->content(static fn (?User $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
                            ]),

                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Select::make('roles')
                                    ->name('Roles')
                                    ->multiple()
                                    ->options(Role::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->afterStateHydrated(static fn ($component, ?User $record) => $component->state($record?->roles->pluck('id') ?? [])),
                            ]),

                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\TextInput::make('clubgg_id')
                                    ->label('ClubGG ID')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->rules([
                                        static function () {
                                            return static function (string $attribute, $value, Closure $fail) {
                                                if (! preg_match('/^[0-9-]+$/', $value)) {
                                                    $fail('Invalid ClubGG ID');
                                                }
                                            };
                                        },
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
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Full name')
                    ->sortable()
                    ->searchable(query: static function (\Illuminate\Contracts\Database\Eloquent\Builder $query, string $search): Builder {
                        return $query
                            ->where('first_name', 'like', "%{$search}%")
                            ->where('last_name', 'like', "%{$search}%");
                    }),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email address')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('email_verified_at')
                    ->label('Verified')
                    ->getStateUsing(static fn (\App\Models\User $record): bool => $record->hasVerifiedEmail())
                    ->enum([
                        true => 'Verified',
                        false => 'Unverified',
                    ])
                    ->colors([
                        'success' => true,
                        'danger' => false,
                    ])
                    ->icons([
                        'heroicon-o-check' => true,
                        'heroicon-o-x' => false,
                    ]),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Phone number')
                    ->searchable(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'first_name',
            'last_name',
            'email',
        ];
    }

    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->full_name;
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Email address' => $record->email_address,
            'Country' => $record->country->name ?? 'Unknown',
        ];
    }

    protected static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()
            ->with([
                'country',
            ]);
    }

    protected static function getNavigationBadge(): ?string
    {
        return number_format(User::query()->count());
    }
}
