<?php

namespace domain\Facades\CountryRegistryFacade;

use domain\Services\CountryRegistryService\CountryRegistryService;
use Illuminate\Support\Facades\Facade;

class CountryRegistryFacade extends Facade
{
    /**
     * getFacadeAccessor
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return CountryRegistryService::class;
    }
}
