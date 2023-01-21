<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class AssetVersion
{
    private static string $cacheKey = 'hpc.asset_hashes';

    private ?array $versions = null;

    public function asset_version(string $file, ?bool $secure = null): string
    {
        $version = $this->version($file);

        return asset($file.'?v='.$version, $secure);
    }

    public function version(string $file): string
    {
        if (isset($this->versions()[$file])) {
            return $this->versions()[$file];
        }

        $version = $this->getFileHash($file);
        $this->versions[$file] = $version;

        $this->updateCache();

        return $version;
    }

    public function versions(): array
    {
        if ($this->versions !== null) {
            return $this->versions;
        }

        return $this->versions = $this->load();
    }

    private function load(): array
    {
        return Cache::get(
            static::$cacheKey,
            []
        );
    }

    private function getFileHash(string $file): string
    {
        return hash_file('md5', public_path($file));
    }

    private function updateCache(): void
    {
        Cache::forever(
            'hpc.asset_hashes',
            $this->versions()
        );
    }
}
