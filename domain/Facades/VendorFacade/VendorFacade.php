<?php

namespace domain\Facades\VendorFacade;

use domain\Services\VendorService\VendorService;
use Illuminate\Support\Facades\Facade;

class VendorFacade extends Facade
{
    /**
     * getFacadeAccessor
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return VendorService::class;
    }
}
