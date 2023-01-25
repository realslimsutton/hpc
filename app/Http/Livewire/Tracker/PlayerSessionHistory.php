<?php

namespace App\Http\Livewire\Tracker;

use Akaunting\Money\Money;
use App\Models\Tracker\ProfessionalPlayer;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\HtmlString;
use Livewire\Component;

class PlayerSessionHistory extends Component implements HasTable
{
    use InteractsWithTable;

    public ProfessionalPlayer $player;

    public function render()
    {
        return view('livewire.tracker.player-session-history');
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
                    $state = empty($state) ? 0 : $state;

                    $formattedState = Money::USD($state);

                    if ($state > 0) {
                        return new HtmlString('<span class="text-green-500">' . $formattedState . '</span>');
                    }

                    return new HtmlString('<span class="text-rose-500">' . $formattedState . '</span>');
                }),
            TextColumn::make('vpip')
                ->label('VPIP (%)')
                ->sortable()
                ->formatStateUsing(static fn($state) => number_format($state * 100) . '%'),
            TextColumn::make('pfr')
                ->label('PFR (%)')
                ->sortable()
                ->formatStateUsing(static fn($state) => number_format($state * 100) . '%'),
            TextColumn::make('hours_played')
                ->label('Hours Played')
                ->sortable()
                ->formatStateUsing(static fn($state) => number_format($state, 1)),
            TextColumn::make('hourly_net_winnings')
                ->label('Hourly $')
                ->sortable()
                ->formatStateUsing(static function ($state) {
                    $state = empty($state) ? 0 : $state;

                    $formattedState = Money::USD($state);

                    if ($state > 0) {
                        return new HtmlString('<span class="text-green-500">' . $formattedState . '</span>');
                    }

                    return new HtmlString('<span class="text-rose-500">' . $formattedState . '</span>');
                }),
            TextColumn::make('hourly_big_blinds')
                ->label('BB/Hour')
                ->sortable()
                ->formatStateUsing(static function ($state) {
                    $formattedState = number_format($state, 2);

                    if ($state > 0) {
                        return new HtmlString('<span class="text-green-500">' . $formattedState . ' BB</span>');
                    }

                    return new HtmlString('<span class="text-rose-500">' . $formattedState . ' BB</span>');
                })
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
        return view('components.tracker.player.historical-chart-summary');
    }

    protected function getTableQuery(): Builder|Relation
    {
        return $this->player->professional_sessions()
            ->with([
                'location',
            ])
            ->select(['professional_sessions.*', 'professional_player_sessions.*'])
            ->selectRaw(
                '(professional_player_sessions.net_winnings / professional_player_sessions.hours_played) AS hourly_net_winnings'
            )
            ->selectRaw(
                '((professional_player_sessions.net_winnings / stakes.big_blind) / professional_player_sessions.hours_played) / 100 AS hourly_big_blinds'
            )
            ->join(
                'stakes',
                'professional_sessions.stake_id',
                '=',
                'stakes.id'
            )
            ->getQuery();
    }
}
