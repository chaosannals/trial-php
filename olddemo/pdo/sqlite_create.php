<?php

require dirname(__DIR__) . '/vendor/autoload.php';

$pdo = pdo_sqlite(__DIR__ . "/test.db");

try {
    $pdo->beginTransaction();
    $pdo->exec(
        "CREATE TABLE t_document (" .
            "[id] INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT," .
            "[content] LONGTEXT NOT NULL" .
            ")"
    );

    $pdo->exec(
        "CREATE TABLE t_term (" .
            "[id] INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT," .
            "[name] VARCHAR(255) NOT NULL" .
            ")"
    );
    $pdo->exec("CREATE INDEX name_index ON t_term([name])");

    $pdo->exec(
        "CREATE TABLE t_index (" .
            "[term_id] INTERGER NOT NULL PRIMARY KEY," .
            "[document_id] INTERGER NOT NULL" .
            ")"
    );
    $pdo->exec("CREATE INDEX document_id_index ON t_index([document_id])");

    $pdo->commit();
} catch (Throwable $t) {
    $pdo->rollBack();
    var_export($t->getMessage());
}
