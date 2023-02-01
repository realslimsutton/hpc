<?php

namespace App\Http\Controllers\Tracker;

use App\Http\Controllers\Controller;
use App\Models\Tracker\Location;
use App\Services\Tracker\LocationService;
use App\Services\Tracker\SessionService;
use DateTimeInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class IndexController extends Controller
{
    public function __invoke(LocationService $locationService, SessionService $sessionService)
    {
        $locations = $locationService->getLocations();
        $latestSessions = $sessionService->getLatestSessions();

        $lastUpdated = $this->getLastUpdatedDateTime($locations, $latestSessions);

        return view('tracker.index', [
            'locations' => $locations,
            'locationRankings' => $locations->mapWithKeys(static fn(Location $location): array => [
                $location->id => $locationService->getLocationRankings($location),
            ]),
            'latestSessions' => $latestSessions,
            'lastUpdated' => $lastUpdated,
        ]);
    }

    protected function getLastUpdatedDateTime(Collection $locations, Collection $sessions): ?DateTimeInterface
    {
        return $locations
            ->pluck('updated_at')
            ->merge($sessions->pluck('updated_at'))
            ->max();
    }
}
