<?php

namespace App\Services;

use App\Models\Announcement;
use Illuminate\Support\Collection;

class AnnouncementService extends BaseService
{
    public function __construct(
        string $cachePrefix = 'announcements',
        int $cacheTtl = 604_800 // 1 week
    ) {
        parent::__construct($cachePrefix, $cacheTtl);
    }

    public function latest(int $limit = 3): Collection
    {
        return $this->cache(
            'latest',
            static fn () => Announcement::query()
                ->published()
                ->latest('published_at')
                ->limit($limit)
                ->get()
        );
    }
}
