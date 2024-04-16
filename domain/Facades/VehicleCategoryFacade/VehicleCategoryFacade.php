<?php

namespace domain\Facades\VehicleCategoryFacade;

use domain\Services\VehicleCategoryService\VehicleCategoryService;
use Illuminate\Support\Facades\Facade;

class VehicleCategoryFacade extends Facade
{
    /**
     * getFacadeAccessor
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return VehicleCategoryService::class;
    }
}
