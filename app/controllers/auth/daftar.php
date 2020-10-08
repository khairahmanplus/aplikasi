<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    get_view('app', 'auth/daftar');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation
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
        get_view('app', 'auth/daftar', [
            'errors_bag' => $errors_bag
        ]);
    }

    // Database
    $pdo = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, DB_OPTIONS);
    $sql_statement = 'INSERT INTO pengguna (nama, emel, kata_laluan) 
    VALUES (:nama, :emel, :kata_laluan)';
    $pdo_statement = $pdo->prepare($sql_statement);
    $pdo_statement->bindValue(':nama', $_POST['nama']);
    $pdo_statement->bindValue(':emel', $_POST['emel']);
    $pdo_statement->bindValue(':kata_laluan', password_hash($_POST['kata_laluan'], PASSWORD_BCRYPT));
    // Redirect

}
