<?php

namespace exert;

use Dotenv\Dotenv;
use Hyperf\Nano\Factory\AppFactory;

/**
 * 应用
 * 
 */
class Application
{
    private $dotenv;
    private $root;
    private $app;

    /**
     * 初始化。
     *
     * @param string $root 项目根目录
     * @param integer $port 端口号
     */
    public function __construct($root, $port = 9051)
    {
        $this->root = $root;
        $this->dotenv = Dotenv::createImmutable($this->root);
        $this->app = AppFactory::create('0.0.0.0', $port);
    }

    /**
     * 应用。
     *
     * @param string $confDir 配置目录
     * @return void
     */
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

    /**
     * 转发 Hyperf Nano 函数调用。
     *
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public function __call($name, $args)
    {
        return $this->app->$name(...$args);
    }
}
