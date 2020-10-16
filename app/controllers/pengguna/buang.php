<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = pdo();
    $sql_statement = 'DELETE FROM pengguna WHERE id = :id';
    $pdo_statement = $pdo->prepare($sql_statement);
    $pdo_statement->bindValue(':id', $_GET['id']);
    $pdo_statement->execute();

    $_SESSION['notifikasi'] = 'Maklumat berjaya dibuang.';

    $url = url('/pengguna');
    header("Location: {$url}");
    die();
}