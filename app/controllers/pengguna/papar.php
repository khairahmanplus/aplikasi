<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $pdo = pdo();
    $sql_statement = 'SELECT * FROM pengguna WHERE id = :id';
    $pdo_statement = $pdo->prepare($sql_statement);
    $pdo_statement->bindValue(':id', $_GET['id']);
    $pdo_statement->execute();
    $pengguna = $pdo_statement->fetch();

    view('app', 'pengguna/papar', [
        'pengguna' => $pengguna
    ]);
}