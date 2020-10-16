<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $pdo = pdo();
    $sql_statement = 'SELECT * FROM pengguna WHERE id = :id';
    $pdo_statement = $pdo->prepare($sql_statement);
    $pdo_statement->bindValue(':id', $_GET['id']);
    $pdo_statement->execute();
    $pengguna = $pdo_statement->fetch();

    view('app', 'pengguna/kemaskini', [
        'pengguna' => $pengguna
    ]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = pdo();

    $errors_bag = [];

    if (empty($_POST['nama'])) {
        $errors_bag['nama'] = 'Medan nama diperlukan.';
    }

    if (empty($_POST['emel'])) {
        $errors_bag['emel'] = 'Medan emel diperlukan.';
    }

    if (empty($_POST['kata_laluan'])) {
        $errors_bag['kata_laluan'] = 'Medan kata laluan diperlukan.';
    }

    if (empty($_POST['pengesahan_kata_laluan'])) {
        $errors_bag['pengesahan_kata_laluan'] = 'Medan pengesahan kata laluan diperlukan.';
    }

    if (! empty($_POST['kata_laluan']) && ! empty($_POST['pengesahan_kata_laluan'])) {
        if ($_POST['kata_laluan'] != $_POST['pengesahan_kata_laluan']) {
            $errors_bag['kata_laluan'] = 'Medan kata laluan tidak sama dengan medan pengesahan kata laluan';
        }
    }

    if (count($errors_bag) > 0) {
        view('app', 'pengguna/kemaskini', [
            'errors_bag' => $errors_bag
        ]);
    }

    // Database
    $sql_statement = 'UPDATE pengguna SET nama = :nama, emel = :emel, kata_laluan = :kata_laluan WHERE id = :id';
    $pdo_statement = $pdo->prepare($sql_statement);
    $pdo_statement->bindValue(':nama', $_POST['nama']);
    $pdo_statement->bindValue(':emel', $_POST['emel']);
    $pdo_statement->bindValue(':kata_laluan', password_hash($_POST['kata_laluan'], PASSWORD_BCRYPT));
    $pdo_statement->bindValue(':id', $_GET['id']);
    $pdo_statement->execute();

    // Notification
    $_SESSION['notifikasi'] = 'Maklumat berjaya didaftarkan.';

    // Redirect
    $url = url('/pengguna');
    header("Location: {$url}");
    die();
}