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
 * 驼峰转蛇皮。
 * 
 */
function camel_to_snake($source)
{
    return preg_replace_callback('/([A-Z])/', function ($matches) {
        return '_' . strtolower($matches[1]);
    }, $source);
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