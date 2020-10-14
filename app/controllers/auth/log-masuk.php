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
        $exists = $pdo_statement->fetchColumn();

        if (! $exists) {
            $errors_bag['emel'] = 'Emel yang diberikan tidak wujud di dalam pangkalan data.';
        }
    }

    
}