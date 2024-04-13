<?php

namespace domain\Facades\VendorDataFacade;

use domain\Services\VendorDataService\VendorDataService;
use Illuminate\Support\Facades\Facade;

/**
 * PurchasingData Facade
 * php version 8
 *
 * @category Facade
 * @author   CyberElysium <contact@cyberelysium.com>
 * @license  https://cyberelysium.com Config
 * @link     https://cyberelysium.com
 * */
class VendorDataFacade extends Facade
{
    /**
     * getFacadeAccessor
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return VendorDataService::class;
    }
}
