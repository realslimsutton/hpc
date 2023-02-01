<?php

namespace App\Http\Livewire\Tracker\Location;

use App\Models\Tracker\Location;
use Closure;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Livewire\Component;

class HistoricalSessionsTable extends Component implements HasTable
{
    use InteractsWithTable;

    public Location $location;

    public function render(): View
    {
        return view('livewire.tracker.location.historical-sessions-table');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
                ->label('Name')
                ->sortable()
                ->searchable(),
            TextColumn::make('date')
                ->label('Date')
                ->sortable()
                ->date(),
            TextColumn::make('game_rules.name')
                ->label('Game played')
                ->sortable()
                ->searchable(),
            TextColumn::make('stake.name')
                ->label('Stake played')
                ->sortable()
                ->searchable(),
            BadgeColumn::make('players_count')
                ->label('Players')
                ->counts('players')
                ->color('primary')
                ->sortable(),
            TextColumn::make('updated_at')
                ->label('Last updated at')
                ->sortable()
                ->date(),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make('game_rules_id')
                ->label('Game played')
                ->options(
                    $this->location->sessions
                        ->pluck('game_rules.name', 'game_rules.id')
                        ->sort()
                        ->unique()
                ),
            SelectFilter::make('stake_id')
                ->label('Stake played')
                ->options(
                    $this->location->sessions
                        ->sortBy(['stake.small_blind', 'stake.big_blind'])
                        ->pluck('stake.name', 'stake.id')
                        ->unique()
                ),
            Filter::make('date')
                ->form([
                    DatePicker::make('date_from'),
                    DatePicker::make('date_to'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['date_from'],
                            fn(Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                        )
                        ->when(
                            $data['date_to'],
                            fn(Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                        );
                }),
        ];
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'date';
    }

    protected function getDefaultTableSortDirection(): ?string
    {
        return 'desc';
    }

    protected function getTableQuery(): Builder|Relation
    {
        return $this->location->sessions()->getQuery();
    }

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return static fn($record): string => route('tracker.session', $record->id);
    }
}
