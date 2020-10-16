<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Dapatkan nombor halaman, jika tiada default 1
    $halaman = $_GET['halaman'] ?? 1;
    // Had rekod setiap halaman
    $had_rekod = PAGINATION_LIMIT;
    // Connection ke database
    $pdo = pdo();

    $sql_statement = 'SELECT COUNT(*) FROM pengguna';
    $pdo_statement = $pdo->prepare($sql_statement);
    $pdo_statement->execute();
    $jumlah_rekod = $pdo_statement->fetchColumn();

    // Jumlah halaman
    $jumlah_halaman = ceil($jumlah_rekod /  $had_rekod);

    // Jumlah offset
    $jumlah_offset = ($halaman - 1) * $had_rekod;

    // Dapatkan rekod
    $sql_statement = 'SELECT * FROM pengguna LIMIT :had_rekod OFFSET :jumlah_offset';
    $pdo_statement = $pdo->prepare($sql_statement);
    $pdo_statement->bindValue(':had_rekod', $had_rekod);
    $pdo_statement->bindValue(':jumlah_offset', $jumlah_offset);
    $pdo_statement->execute();
    $senarai_pengguna = $pdo_statement->fetchAll();

    view('app', 'pengguna/senarai', [
        'senarai_pengguna' => $senarai_pengguna,
        'jumlah_halaman' => $jumlah_halaman
    ]);
}