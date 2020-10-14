<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    view('app', 'auth/log-masuk');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database Connection
    $pdo = pdo();

    // Validation
    $errors_bag = [];

    if (empty($_POST['emel'])) {
        $errors_bag['emel'] = 'Medan emel diperlukan.';
    }

    if (empty($_POST['kata_laluan'])) {
        $errors_bag['kata_laluan'] = 'Medan kata laluan diperlukan.';
    }

    if (! empty($_POST['emel'])) {
        $sql_statement = 'SELECT EXISTS(SELECT * FROM pengguna WHERE emel = :emel) AS existence';
        $pdo_statement = $pdo->prepare($sql_statement);
        $pdo_statement->bindValue(':emel', $_POST['emel']);
        $pdo_statement->execute();
        $exists = $pdo_statement->fetchColumn();

        if (! $exists) {
            $errors_bag['emel'] = 'Emel yang diberikan tidak wujud di dalam pangkalan data.';
        }
    }
    

    if (! empty($_POST['emel'] && ! $_POST['kata_laluan'])) {
        $sql_statement = 'SELECT * FROM pengguna WHERE emel = :emel';
        $pdo_statement = $pdo->prepare($sql_statement);
        $pdo_statement->bindValue(':emel', $_POST['emel']);
        $pdo_statement->execute();
        $user = $pdo_statement->fetch();

        if (! password_verify($_POST['kata_laluan'], $user->password)) {
            $errors_bag['emel'] = 'Medan emel dan kata laluan tidak sepadan.';
        }
    }

    if (count($errors_bag) > 0) {
        view('app', 'auth/log-masuk', [
            'errors_bag' => $errors_bag
        ]);
    }

    // Generate new session ID
    session_regenerate_id();
    // Cipta satu key unik berdasarkan session ID
    $key = 'web_login_' . session_id();
    // Simpan id pengguna dengan menggunakan key unik
    $_SESSION[$key] = $user->id;
    // Notifikasi
    $_SESSION['notifikasi'] = 'Anda berjaya log masuk ke dalam aplikasi.';
    // Redirect kepada /home
    $url = url('/home');
    header("Location: {$url}");
    die();
}