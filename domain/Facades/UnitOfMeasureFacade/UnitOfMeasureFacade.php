<?php

namespace domain\Facades\UnitOfMeasureFacade;

use domain\Services\UnitOfMeasureService\UnitOfMeasureService;
use Illuminate\Support\Facades\Facade;

/**
 * UnitOfMeasure Facade
 * php version 8
 *
 * @category Facade
 * @author   CyberElysium <contact@cyberelysium.com>
 * @license  https://cyberelysium.com Config
 * @link     https://cyberelysium.com
 * */
class UnitOfMeasureFacade extends Facade
{
    /**
     * getFacadeAccessor
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return UnitOfMeasureService::class;
    }
}
