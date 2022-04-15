<?php

namespace Wefabric\Support\Geo;

use Illuminate\Support\Collection;
use Wefabric\Support\Composer;
use Wefabric\Support\Exceptions\CountryISONotFoundException;

class Countries
{
    const DEFAULT_ISO = 'EN';

    public static ?Collection $countries = null;

    public static function get(string $iso = ''): Collection
    {
        if(!$iso) {
            $iso = self::DEFAULT_ISO;
        }

        $iso = strtolower($iso);

        if(self::$countries === null || !self::$countries->get($iso)) {
            self::setCountries($iso);
        }

        return self::$countries->get($iso);
    }

    private static function setCountries(string $iso): void
    {
        if(null === self::$countries) {
            self::$countries = new Collection();
        }
        self::$countries->put($iso, (new Collection(self::getCountryDataFromPath($iso)))->recursive());
    }

    private static function getCountryDataFromPath(string $iso)
    {
        $vendorDir = Composer::getVendorDirectory();
        $countriesDir = $vendorDir .= '/stefangabos/world_countries/data/countries';
        $isoDir = $countriesDir.'/'.$iso;

        if(!file_exists($countriesDir.'/'.$iso)) {
            throw new CountryISONotFoundException(sprintf('Country ISO "%s" not found in directory "%s"', $iso, $countriesDir));
        }

        return require $isoDir.'/world.php';
    }
}
