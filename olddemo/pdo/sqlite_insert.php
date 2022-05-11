<?php

require dirname(__DIR__) . '/vendor/autoload.php';

$pdo = pdo_sqlite(__DIR__ . "/test.db");

$stmt = $pdo->prepare("INSERT INTO t_term(name) VALUES (:name)");
for ($i = 0; $i < 100; ++$i) {
    $stmt->execute([
        'name' => random_int(10000, 90000),
    ]);
}
