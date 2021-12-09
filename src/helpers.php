<?php

if(!function_exists('novaRoute')) {
    function novaRoute(): \Wefabric\Support\Nova\NovaRoute
    {
        return new \Wefabric\Support\Nova\NovaRoute();
    }
}

if(!function_exists('formatPrice')) {
    function formatPrice($price, int $decimals = 2, bool $withCurrencySymbol = true)
    {
        return \Wefabric\Support\Money\Money::formatPrice($price, $decimals = 2, $withCurrencySymbol);
    }
}
