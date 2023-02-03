<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnnouncementResource\Pages;
use App\Filament\Resources\AnnouncementResource\RelationManagers;
use App\Models\Announcement;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;

    protected static ?string $navigationIcon = 'heroicon-o-speakerphone';

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
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Publish at')
                            ->nullable()
                            ->default(now())
                            ->helperText('Leaving this empty will it mark as draft'),
                        Forms\Components\MarkdownEditor::make('body')
                            ->label('Body')
                            ->columnSpan(2)
                            ->nullable()
                            ->maxLength(65535),
                    ]),

                Forms\Components\Grid::make()
                    ->columnSpan(1)
                    ->schema([
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Select::make('user_id')
                                    ->label('Author')
                                    ->relationship('author', 'full_name')
                                    ->preload()
                                    ->searchable()
                                    ->required()
                                    ->default(auth()->id()),
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(static fn(?Announcement $record): string => $record?->created_at?->diffForHumans() ?? '-'),
                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Updated at')
                                    ->content(static fn(?Announcement $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('published_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(static fn(string $state): string => Str::title($state))
                    ->colors([
                        'secondary' => 'draft',
                        'warning' => 'pending',
                        'success' => 'published',
                    ]),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Published at')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'pending' => 'Pending',
                        'published' => 'Published',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['value'] === 'draft',
                                fn(Builder $query, $date): Builder => $query->whereNull('published_at'),
                            )
                            ->when(
                                $data['value'] === 'pending',
                                fn(Builder $query, $date): Builder => $query->whereDate('published_at', '>', now()),
                            )
                            ->when(
                                $data['value'] === 'publushed',
                                fn(Builder $query, $date): Builder => $query->whereDate('published_at', '<=', now()),
                            );
                    }),
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
            'index' => Pages\ListAnnouncements::route('/'),
            'create' => Pages\CreateAnnouncement::route('/create'),
            'edit' => Pages\EditAnnouncement::route('/{record}/edit'),
        ];
    }
}
