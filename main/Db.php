<?php

namespace exert;

use Hyperf\Utils\ApplicationContext;

class Db
{
    public static function get()
    {
        return ApplicationContext::getContainer()
            ->get(\Hyperf\DB\DB::class);
    }
}
