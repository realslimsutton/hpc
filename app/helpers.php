<?php

use App\Support\AssetVersion;

if (! function_exists('asset_version')) {
    function asset_version(string $file, ?bool $secure = null): string
    {
        return app(AssetVersion::class)->asset_version($file, $secure);
    }
}
