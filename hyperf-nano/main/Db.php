<?php

namespace exert;

use Hyperf\Utils\ApplicationContext;

class Db
{
    public static function get($name='default')
    {
        return ApplicationContext::getContainer()
            ->get(\Hyperf\DB\DB::class)
            ->connection($name);
    }
}
