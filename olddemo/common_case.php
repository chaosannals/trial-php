<?php

/**
 * 蛇皮转驼峰。
 * 
 */
function snake_to_camel($source)
{
    return preg_replace_callback('/_([a-z])/', function ($matches) {
        return strtoupper($matches[1]);
    }, $source);
}

/**
 * 蛇皮转烤串。
 * 
 */
function snake_to_kebab($source)
{
    return str_replace('_', '-', $source);
}

/**
 * 蛇皮转帕斯卡。
 * 
 *
 * @param [type] $source
 * @return void
 */
function snake_to_pascal($source)
{
    return preg_replace_callback('/(?:^|_)([a-z])/', function ($matches) {
        return strtoupper($matches[1]);
    }, $source);
}

/**
 * 驼峰转蛇皮。
 * 
 */
function camel_to_snake($source)
{
    return strtolower(preg_replace_callback('/(.)([A-Z])/', function ($matches) {
        return $matches[1] . '_' . $matches[2];
    }, $source));
}

/**
 * 驼峰转烤串。
 * 
 */
function camel_to_kebab($source)
{
    return preg_replace_callback('/([A-Z])/', function ($matches) {
        return '-' . strtolower($matches[1]);
    }, $source);
}

/**
 * 驼峰转帕斯卡。
 *
 * @param string $source
 * @return string
 */
function camel_to_pascal($source)
{
    return ucfirst($source);
}

/**
 * 烤串转蛇皮。
 * 
 */
function kebab_to_snake($source)
{
    return str_replace('-', '_', $source);
}

/**
 * 烤串转驼峰。
 * 
 */
function kebab_to_camel($source)
{
    return preg_replace_callback('/-([a-z])/', function ($matches) {
        return strtoupper($matches[1]);
    }, $source);
}

/**
 * 烤串转帕斯卡。
 *
 * @param string $source
 * @return string
 */
function kebab_to_pascal($source)
{
    return preg_replace_callback('/(?:^|-)([a-z])/', function ($matches) {
        return strtoupper($matches[1]);
    }, $source);
}

/**
 * 帕斯卡转蛇皮。
 *
 * @param string $source
 * @return string
 */
function pascal_to_snake($source)
{
    return strtolower(preg_replace_callback('/(.)([A-Z])/', function ($matches) {
        return $matches[1] . '_' . $matches[2];
    }, $source));
}

/**
 * 帕斯卡转驼峰。
 *
 * @param string $source
 * @return string
 */
function pascal_to_camel($source)
{
    return lcfirst($source);
}

/**
 * 帕斯卡转烤串。
 *
 * @param string $source
 * @return string
 */
function pascal_to_kebab($source)
{
    return strtolower(preg_replace_callback('/(.)([A-Z])/', function ($matches) {
        return $matches[1] . '-' . $matches[2];
    }, $source));
}

function snake_short($text)
{
    preg_match_all('/^[a-z]|_[a-z]/', $text, $matches);
    return str_replace('_', '', join($matches[0]));
}

function camel_short($text)
{
    preg_match_all('/^[a-zA-Z]|[A-Z]/', $text, $matches);
    return join($matches[0]);
}

function kebab_short($text)
{
    preg_match_all('/^[a-z]|-[a-z]/', $text, $matches);
    return str_replace('-', '', join($matches[0]));
}
