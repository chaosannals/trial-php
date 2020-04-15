<?php

function pdo_mysql($username, $password, $host = '127.0.0.1', $port = 3306)
{
    $dsn = "mysql:host=$host;port=$port";
    return new PDO($dsn, $username, $password);
}
