<?php

namespace domain\Facades\VendorBankFacade;

use domain\Services\VendorBankService\VendorBankService;
use Illuminate\Support\Facades\Facade;

class VendorBankFacade extends Facade
{    
    /**
     * getFacadeAccessor
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return VendorBankService::class;
    }
}
