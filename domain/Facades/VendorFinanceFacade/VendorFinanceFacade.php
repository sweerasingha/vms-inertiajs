<?php

namespace domain\Facades\VendorFinanceFacade;

use domain\Services\VendorFinanceService\VendorFinanceService;
use Illuminate\Support\Facades\Facade;

class VendorFinanceFacade extends Facade
{    
    /**
     * getFacadeAccessor
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return VendorFinanceService::class;
    }
}
