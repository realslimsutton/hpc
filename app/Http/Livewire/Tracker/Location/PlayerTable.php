<?php

namespace App\Http\Livewire\Tracker\Location;

use Akaunting\Money\Money;
use App\Models\Tracker\Location;
use App\Models\Tracker\PlayerSession;
use Closure;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\HtmlString;
use Livewire\Component;

class PlayerTable extends Component implements HasTable
{
    use InteractsWithTable;

    public Location $location;

    public bool $loaded = false;

    protected $listeners = [
        'showPlayers' => 'load',
    ];

    public function render(): View
    {
        return view('livewire.tracker.location.player-table');
    }

    public function load()
    {
        if ($this->loaded) {
            return;
        }

        $this->loaded = true;

        $this->dispatchBrowserEvent('players-loaded');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('player.name')
                ->label('Name')
                ->sortable()
                ->searchable(),
            TextColumn::make('net_winnings')
                ->label('Net winnings')
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
                ->label('VPIP')
                ->sortable()
                ->formatStateUsing(static function ($state) {
                    if (!filled($state)) {
                        return '-';
                    }

                    return number_format($state) . '%';
                }),
            TextColumn::make('pfr')
                ->label('PFR')
                ->sortable()
                ->formatStateUsing(static function ($state) {
                    if (!filled($state)) {
                        return '-';
                    }

                    return number_format($state) . '%';
                }),
            TextColumn::make('hours_played')
                ->label('Hours played')
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

    protected function getTableQuery(): Builder|Relation
    {
        return PlayerSession::query()
            ->select(['player_session.player_id'])
            ->selectRaw(
                'SUM(player_session.net_winnings) AS net_winnings'
            )
            ->selectRaw(
                'AVG(player_session.vpip) AS vpip'
            )
            ->selectRaw(
                'AVG(player_session.pfr) AS pfr'
            )
            ->selectRaw(
                'SUM(player_session.hours_played) AS hours_played'
            )
            ->selectRaw(
                'AVG(player_session.net_winnings / player_session.hours_played) AS hourly_net_winnings'
            )
            ->selectRaw(
                'AVG((player_session.net_winnings / stakes.big_blind) / player_session.hours_played) / 100 AS hourly_bb'
            )
            ->join(
                'sessions',
                'player_session.session_id',
                '=',
                'sessions.id'
            )
            ->join(
                'players',
                'player_session.player_id',
                '=',
                'players.id'
            )
            ->join(
                'stakes',
                'sessions.stake_id',
                '=',
                'stakes.id'
            )
            ->join(
                'game_rules',
                'sessions.game_rules_id',
                '=',
                'game_rules.id'
            )
            ->where('players.enabled', '=', 1)
            ->where('sessions.location_id', '=', $this->location->id)
            ->groupBy('player_session.player_id');
    }

    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make('game_rules_id')
                ->label('Game played')
                ->options($this->location->sessions
                    ->pluck('game_rules.name', 'game_rules.id')
                    ->sort()
                    ->unique()
                )
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['value'],
                            static fn(Builder $query, $value) => $query->where('game_rules.id', '=', $value)
                        );
                }),
            SelectFilter::make('stake_id')
                ->label('Stake played')
                ->options($this->location->sessions
                    ->sortBy(['stake.small_blind', 'stake.big_blind'])
                    ->pluck('stake.name', 'stake.id')
                    ->unique()
                )
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['value'],
                            static fn(Builder $query, $value) => $query->where('stakes.id', '=', $value)
                        );
                }),
            Filter::make('date')
                ->form([
                    DatePicker::make('date_from'),
                    DatePicker::make('date_to'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['date_from'],
                            fn(Builder $query, $date): Builder => $query->whereDate('sessions.date', '>=', $date),
                        )
                        ->when(
                            $data['date_to'],
                            fn(Builder $query, $date): Builder => $query->whereDate('sessions.date', '<=', $date),
                        );
                }),
        ];
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'net_winnings';
    }

    protected function getDefaultTableSortDirection(): ?string
    {
        return 'desc';
    }

    public function getTableRecordKey(Model $record): string
    {
        return $record->player_id;
    }

    protected function getTableQueryStringIdentifier(): string
    {
        return 'players';
    }

    protected function getTableContentFooter(): ?View
    {
        return view('components.tracker.location.player-table.table-summary');
    }

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return static fn($record): string => route('tracker.player', $record->player_id);
    }

    protected function paginateTableQuery(Builder $query): Paginator
    {
        $records = $query->paginate(
            $this->getTableRecordsPerPage() === -1 ? $this->getQueryCount() : $this->getTableRecordsPerPage(),
            ['*'],
            $this->getTablePaginationPageName(),
        );

        return $records->onEachSide(1);
    }

    protected function getQueryCount(): int
    {
        return PlayerSession::query()
            ->join(
                'sessions',
                'player_session.session_id',
                '=',
                'sessions.id'
            )
            ->where('sessions.location_id', '=', $this->location->id)
            ->count();
    }
}
