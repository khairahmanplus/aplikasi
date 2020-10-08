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
    

    // Redirect
}
