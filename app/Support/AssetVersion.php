<?php

namespace App\Support;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use function public_path;

class AssetVersion
{
    private static string $cacheKey = 'hpc.asset_hashes';

    private ?array $versions = null;

    public function asset_version(string $file, ?bool $secure = null): string
    {
        $version = $this->version($file);
        if ($version === null) {
            return asset($file, $secure);
        }

        return asset($file . '?v=' . $version, $secure);
    }

    public function version(string $file): ?string
    {
        if (isset($this->versions()[$file])) {
            return $this->versions()[$file];
        }

        if (!$version = $this->getFileHash($file)) {
            return null;
        }

        $this->versions[$file] = $version;

        $this->updateCache();

        return $version;
    }

    public function versions(): array
    {
        if (filled($this->versions)) {
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

    private function getFileHash(string $file): ?string
    {
        return rescue(static function () use ($file) {
            $path = public_path($file);

            if (!File::exists($path)) {
                throw new FileNotFoundException(
                    sprintf('Cannot find asset "%s"', $path)
                );
            }

            return hash_file('md5', $path);
        });
    }

    private function updateCache(): void
    {
        Cache::forever(
            'hpc.asset_hashes',
            $this->versions()
        );
    }
}
