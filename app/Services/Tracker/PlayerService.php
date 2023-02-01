<?php

namespace App\Services\Tracker;

use App\Models\Tracker\Player;
use App\Models\Tracker\Session;
use App\Services\BaseService;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class PlayerService extends BaseService
{
    public function __construct(
        private readonly SessionService $sessionService,
        string                          $cachePrefix = 'tracker.players',
        int                             $cacheTtl = 86400
    )
    {
        parent::__construct($cachePrefix, $cacheTtl);
    }

    public function findOrFail($id, bool $enabled = true): Player
    {
        return $this->cache(
            'find.' . $id,
            static fn() => Player::query()
                ->with([
                    'country',
                    'sessions' => static function (Builder $query) {
                        $query->orderBy('date');
                    },
                    'sessions.stake',
                    'sessions.location',
                    'sessions.game_rules',
                ])
                ->where('players.enabled', '=', $enabled)
                ->findOrFail($id)
        );
    }

    public function getFacts(Player $player): array
    {
        return [
            'hometown' => $player->hometown,
            'country' => $player->country,
            'profession' => $player->profession,

            ...$this->sessionService->getFacts($player->sessions),
        ];
    }
}
