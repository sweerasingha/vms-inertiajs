<?php

namespace domain\Facades\VehicleBankFacade;

use domain\Services\VehicleBankService\VehicleBankService;
use Illuminate\Support\Facades\Facade;

class VehicleBankFacade extends Facade
{    
    /**
     * getFacadeAccessor
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return VehicleBankService::class;
    }
}
