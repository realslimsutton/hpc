<?php

namespace App\Http\Livewire\Tracker\Player;

use Akaunting\Money\Money;
use App\Models\Tracker\Player;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\HtmlString;
use Livewire\Component;

class HistoricalSessionTable extends Component implements HasTable
{
    use InteractsWithTable;

    public Player $player;

    public function render(): View
    {
        return view('livewire.tracker.player.historical-session-table');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('date')
                ->label('Date')
                ->date()
                ->sortable(),
            TextColumn::make('name')
                ->label('Name')
                ->sortable()
                ->searchable(),
            TextColumn::make('location.name')
                ->label('Location')
                ->sortable()
                ->searchable(),
            TextColumn::make('net_winnings')
                ->label('Net Winnings')
                ->sortable()
                ->formatStateUsing(static function ($state) {
                    if (!filled($state)) {
                        return '-';
                    }

                    $formattedState = Money::USD($state);

                    if ($state > 0) {
                        return new HtmlString('<span class="text-green-500">' . $formattedState . '</span>');
                    }

                    return new HtmlString('<span class="text-rose-500">' . $formattedState . '</span>');
                }),
            TextColumn::make('vpip')
                ->label('VPIP (%)')
                ->sortable()
                ->formatStateUsing(static function ($state) {
                    if (!filled($state)) {
                        return '-';
                    }

                    return number_format($state) . '%';
                }),
            TextColumn::make('pfr')
                ->label('PFR (%)')
                ->sortable()
                ->formatStateUsing(static function ($state) {
                    if (!filled($state)) {
                        return '-';
                    }

                    return number_format($state) . '%';
                }),
            TextColumn::make('hours_played')
                ->label('Hours Played')
                ->sortable()
                ->formatStateUsing(static function ($state) {
                    if (!filled($state)) {
                        return '-';
                    }

                    return number_format($state, 2);
                }),
            TextColumn::make('hourly_net_winnings')
                ->label('Hourly $')
                ->sortable()
                ->formatStateUsing(static function ($state) {
                    if (!filled($state)) {
                        return '-';
                    }

                    $formattedState = Money::USD($state);

                    if ($state > 0) {
                        return new HtmlString('<span class="text-green-500">' . $formattedState . '</span>');
                    }

                    return new HtmlString('<span class="text-rose-500">' . $formattedState . '</span>');
                }),
            TextColumn::make('hourly_bb')
                ->label('BB/Hour')
                ->sortable()
                ->formatStateUsing(static function ($state) {
                    if (!filled($state)) {
                        return '-';
                    }

                    $formattedState = number_format($state, 2);

                    if ($state > 0) {
                        return new HtmlString('<span class="text-green-500">' . $formattedState . ' BB</span>');
                    }

                    return new HtmlString('<span class="text-rose-500">' . $formattedState . ' BB</span>');
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

    protected function getTableContentFooter(): ?View
    {
        return view('components.tracker.player.historical-session.table-summary');
    }

    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make('location_id')
                ->label('Livestream')
                ->options($this->player->sessions
                    ->pluck('location.name', 'location.id')
                    ->sort()
                    ->unique()
                ),
            SelectFilter::make('game_rules_id')
                ->label('Game played')
                ->options($this->player->sessions
                    ->pluck('game_rules.name', 'game_rules.id')
                    ->sort()
                    ->unique()
                ),
            SelectFilter::make('stake_id')
                ->label('Stake played')
                ->options($this->player->sessions
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
                })
        ];
    }

    protected function getTableQuery(): Builder|Relation
    {
        return $this->player->sessions()
            ->with([
                'location',
            ])
            ->select(['sessions.*', 'player_session.*'])
            ->selectRaw(
                '(player_session.net_winnings / player_session.hours_played) AS hourly_net_winnings'
            )
            ->selectRaw(
                '((player_session.net_winnings / stakes.big_blind) / player_session.hours_played) / 100 AS hourly_bb'
            )
            ->join(
                'stakes',
                'sessions.stake_id',
                '=',
                'stakes.id'
            )
            ->getQuery();
    }
}
