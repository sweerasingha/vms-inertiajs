<?php

namespace domain\Facades\VehicleContactFacade;

use domain\Services\VehicleContactService\VehicleContactService;
use Illuminate\Support\Facades\Facade;

class VehicleContactFacade extends Facade
{
    /**
     * getFacadeAccessor
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return VehicleContactService::class;
    }
}
