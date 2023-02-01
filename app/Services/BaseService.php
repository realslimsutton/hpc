<?php

namespace App\Services;

use Closure;
use Illuminate\Support\Facades\Cache;

abstract class BaseService
{
    public function __construct(
        protected string $cachePrefix,
        protected int    $cacheTtl = 86400
    )
    {
    }

    public function setCachePrefix(string $prefix): void
    {
        $this->cachePrefix = $prefix;
    }

    public function setCacheTtl(int $ttl): void
    {
        $this->cacheTtl = $ttl;
    }

    protected function cache(string $key, Closure $callback)
    {
        return Cache::remember(
            $this->getCacheKey($key),
            $this->cacheTtl,
            $callback
        );
    }

    protected function getCacheKey(string $key): string
    {
        return $this->cachePrefix . '.' . $key;
    }
}
