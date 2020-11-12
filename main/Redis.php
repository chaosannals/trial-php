<?php

namespace exert;

use Hyperf\Utils\ApplicationContext;
use Hyperf\Redis\RedisFactory;

class Redis
{
    public static function get($name = 'default')
    {
        return ApplicationContext::getContainer()
            ->get(RedisFactory::class)
            ->get($name);
    }
}
