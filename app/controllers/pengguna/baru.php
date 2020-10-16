<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    view('app', 'pengguna/baru');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = pdo();

    // Validation
    $errors_bag = [];

    if (empty($_POST['nama'])) {
        $errors_bag['nama'] = 'Medan nama diperlukan.';
    }

    if (empty($_POST['emel'])) {
        $errors_bag['emel'] = 'Medan emel diperlukan.';
    }

    if (! empty($_POST['emel'])) {
        $sql_statement = 'SELECT EXISTS (SELECT * FROM pengguna WHERE emel = :emel) AS existence';
        $pdo_statement = $pdo->prepare($sql_statement);
        $pdo_statement->bindValue(':emel', $_POST['emel']);
        $pdo_statement->execute();
        $exists = $pdo_statement->fetchColumn();
        if ($exists) {
            $errors_bag['emel'] = 'Emel telah wujud di dalam pangkalan data.';
        }
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
        view('app', 'pengguna/baru', [
            'errors_bag' => $errors_bag
        ]);
    }

    // Database
    $sql_statement = 'INSERT INTO pengguna (nama, emel, kata_laluan) VALUES (:nama, :emel, :kata_laluan)';
    $pdo_statement = $pdo->prepare($sql_statement);
    $pdo_statement->bindValue(':nama', $_POST['nama']);
    $pdo_statement->bindValue(':emel', $_POST['emel']);
    $pdo_statement->bindValue(':kata_laluan', password_hash($_POST['kata_laluan'], PASSWORD_BCRYPT));
    $pdo_statement->execute();

    // Notification
    $_SESSION['notifikasi'] = 'Maklumat berjaya didaftarkan.';

    // Redirect
    $url = url('/pengguna');
    header("Location: {$url}");
    die();
}