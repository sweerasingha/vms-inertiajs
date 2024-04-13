<?php

namespace domain\Facades\VendorPartnerFacade;

use domain\Services\VendorPartnerService\VendorPartnerService;
use Illuminate\Support\Facades\Facade;

class VendorPartnerFacade extends Facade
{
    /**
     * getFacadeAccessor
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return VendorPartnerService::class;
    }
}
