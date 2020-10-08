<?php

$dsn = 'mysql:unix_socket=/tmp/mysql_3306.sock;port=3306;charset=utf8mb4';
$username = 'root';
$password = null;
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
    $sql_statement = file_get_contents('init.sql');
    $pdo->exec($sql_statement);
    echo 'Berjaya setup database.';
} catch (PDOException $exception) {
    echo 'Terdapat masalah ketika setup database:' . PHP_EOL;
    echo $exception->getMessage();
}

