<?php

namespace Wefabric\Support;

class Composer
{

    public static function getVendorDirectory(): string 
    {
        $reflection = new \ReflectionClass(\Composer\Autoload\ClassLoader::class);
        return dirname(dirname($reflection->getFileName()));
    }
}
