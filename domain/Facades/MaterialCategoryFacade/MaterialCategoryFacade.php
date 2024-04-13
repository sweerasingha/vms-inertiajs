<?php

namespace domain\Facades\MaterialCategoryFacade;

use domain\Services\MaterialCategoryService\MaterialCategoryService;
use Illuminate\Support\Facades\Facade;

class MaterialCategoryFacade extends Facade
{
    /**
     * getFacadeAccessor
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return MaterialCategoryService::class;
    }
}
