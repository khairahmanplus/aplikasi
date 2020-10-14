<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    view('app', 'auth/log-masuk');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database Connection
    $pdo = pdo();
    
    // Validation

    //
}