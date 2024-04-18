<?php

namespace domain\Facades\VehicleFacade;

use domain\Services\VehicleService\VehicleService;
use Illuminate\Support\Facades\Facade;

class VehicleFacade extends Facade
{
    /**
     * getFacadeAccessor
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return VehicleService::class;
    }
}
