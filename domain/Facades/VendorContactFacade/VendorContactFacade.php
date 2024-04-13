<?php

namespace domain\Facades\VendorContactFacade;

use domain\Services\VendorContactService\VendorContactService;
use Illuminate\Support\Facades\Facade;

class VendorContactFacade extends Facade
{    
    /**
     * getFacadeAccessor
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return VendorContactService::class;
    }
}
