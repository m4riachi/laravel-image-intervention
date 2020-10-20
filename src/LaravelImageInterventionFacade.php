<?php

namespace M4riachi\LaravelImageIntervention;

use Illuminate\Support\Facades\Facade;

/**
 * @see \M4riachi\LaravelImageIntervention\Skeleton\SkeletonClass
 */
class LaravelImageInterventionFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-image-intervention';
    }
}
