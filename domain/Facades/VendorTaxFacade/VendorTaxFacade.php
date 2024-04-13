<?php

namespace domain\Facades\VendorTaxFacade;

use domain\Services\VendorTaxService\VendorTaxService;
use Illuminate\Support\Facades\Facade;

class VendorTaxFacade extends Facade
{
    /**
     * getFacadeAccessor
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return VendorTaxService::class;
    }
}
