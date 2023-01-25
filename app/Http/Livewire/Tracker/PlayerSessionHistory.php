<?php

namespace App\Http\Livewire\Tracker;

use Akaunting\Money\Money;
use App\Models\Tracker\ProfessionalPlayer;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
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
            Split::make([
                TextColumn::make('date')
                    ->label('Date')
                    ->date()
                    ->sortable(),
                Stack::make([
                    TextColumn::make('name')
                        ->label('Name')
                        ->sortable()
                        ->searchable(),
                    TextColumn::make('location.name')
                        ->label('Location')
                        ->sortable()
                        ->searchable()
                        ->formatStateUsing(static fn ($state) => new HtmlString('<span class="text-hpc-gold text-sm">'.$state.'</span>')),
                ]),
                TextColumn::make('net_winnings')
                    ->sortable()
                    ->description('Net Winnings', position: 'above')
                    ->formatStateUsing(static function ($state) {
                        $formattedState = Money::USD($state);

                        if ($state > 0) {
                            return new HtmlString('<span class="text-green-500">'.$formattedState.'</span>');
                        }

                        return new HtmlString('<span class="text-rose-500">'.$formattedState.'</span>');
                    }),
                TextColumn::make('vpip')
                    ->sortable()
                    ->formatStateUsing(static fn ($state) => number_format($state * 100).'%')
                    ->description('VPIP (%)', position: 'above'),
                TextColumn::make('pfr')
                    ->sortable()
                    ->formatStateUsing(static fn ($state) => number_format($state * 100).'%')
                    ->description('PFR (%)', position: 'above'),
                TextColumn::make('hours_played')
                    ->sortable()
                    ->formatStateUsing(static fn ($state) => number_format($state, 1))
                    ->description('Hours Played', position: 'above'),
            ])->from('md'),
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
        return $this->player->professional_sessions()
            ->with([
                'location',
            ])
//            ->selectRaw('professional_sessions.*, professional_sessions.net_winnings / professional_sessions.hours_played AS hourly_net_winnings')
            ->getQuery();
    }
}
