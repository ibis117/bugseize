<?php

namespace Ibis117\Bugseize\Facades;

use Illuminate\Support\Facades\Facade;

class Bugseize extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'bugseize';
    }
}
