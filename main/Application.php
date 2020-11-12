<?php

namespace exert;

use Dotenv\Dotenv;
use Hyperf\Nano\Factory\AppFactory;

class Application
{
    private $dotenv;
    private $root;
    private $app;

    public function __construct($root, $port = 9051)
    {
        $this->root = $root;
        $this->dotenv = Dotenv::createImmutable($this->root);
        $this->app = AppFactory::create('0.0.0.0', $port);
    }

    public function apply($confDir = 'conf')
    {
        $this->dotenv->load();
        // 加载配置。
        $conf = [];
        foreach (glob("$confDir/*.php") as $filename) {
            $name = basename($filename, '.php');
            $conf[$name] = include $filename;
        }
        $this->app->config($conf);
    }

    public function __call($name, $args)
    {
        return $this->app->$name(...$args);
    }
}
