<?php

namespace Wefabric\Support\Nova;

use Illuminate\Support\Pluralizer;

class NovaRoute
{

    /**
     * @return string
     */
    public function route(): string
    {
        return url(config('nova.path'));
    }

    /**
     * @param $resource
     * @param int $id
     * @return string
     */
    public function resourceRoute($resource, int $id = 0, string $suffix = ''): string
    {
        $url = $this::route().'/resources/'.Pluralizer::plural($resource);
        if($id !== 0) {
            $url .= '/'.$id;
        }
        if($suffix) {
            $url .= '/'.$suffix;
        }
        return $url;
    }
}
