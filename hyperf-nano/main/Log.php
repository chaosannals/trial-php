<?php

namespace exert;

use Hyperf\Logger\LoggerFactory;
use Hyperf\Utils\ApplicationContext;

class Log
{
    public static function get($name = 'app')
    {
        return ApplicationContext::getContainer()
            ->get(LoggerFactory::class)
            ->get($name);
    }
}
