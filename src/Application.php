<?php

namespace Wefabric\Support;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class Application
{
    public static function getVersion(): string
    {
        return Cache::driver('array')->rememberForever('application.version', function () {
            $manifest = json_decode(File::get(base_path().'/composer.json'), true);
            return $manifest['version'] ?? '1.x';
        });
    }
}
