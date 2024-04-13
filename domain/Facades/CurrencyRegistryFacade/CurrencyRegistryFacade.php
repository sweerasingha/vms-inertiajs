<?php

namespace domain\Facades\CurrencyRegistryFacade;

use domain\Services\CurrencyRegistryService\CurrencyRegistryService;
use Illuminate\Support\Facades\Facade;

class CurrencyRegistryFacade extends Facade
{
    /**
     * getFacadeAccessor
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return CurrencyRegistryService::class;
    }
}
