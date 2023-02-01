<?php

namespace App\Http\Livewire\Tracker;

use App\Models\Tracker\Location;
use App\Models\Tracker\Player;
use App\Models\Tracker\Session;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use ProtoneMedia\LaravelCrossEloquentSearch\Search as EloquentSearch;

class Search extends Component
{
    public string $search = '';

    public int $currentPage = 1;

    public function render(): View
    {
        return view('livewire.tracker.search', [
            'results' => $this->getSearchResults(),
        ]);
    }

    public function previousPage(): void
    {
        if ($this->currentPage === 1) {
            return;
        }

        $this->currentPage--;

        $this->dispatchBrowserEvent('reset-scroll');
    }

    public function nextPage(): void
    {
        $this->currentPage++;

        $this->dispatchBrowserEvent('reset-scroll');
    }

    protected function getSearchResults(): ?Paginator
    {
        if (empty($this->search)) {
            return null;
        }

        $results = EloquentSearch::new()
            ->add(
                Player::query()
                    ->with([
                        'featured_image',
                    ]),
                ['name', 'nickname']
            )
            ->add(
                Session::query()
                    ->with([
                        'location',
                        'location.featured_image',
                    ]),
                'name'
            )
            ->add(
                Location::query()
                    ->with([
                        'featured_image',
                    ]),
                'name'
            )
            ->orderByRelevance()
            ->simplePaginate(
                page: $this->currentPage
            )
            ->search($this->search);

        return $results;
    }
}
