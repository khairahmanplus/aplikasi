<?php

// Nama cookie
ini_set('session.name',  '_aplikasi_');
// Menggunakan cookie untuk simpan id session
ini_set('session.use_cookies', true);
// Menggunakan cookie sahaja untuk simpan id session
ini_set('session.use_only_cookies', true);
// Kitar hayat cookie, default 0, hanya mati ketika browser ditutup
ini_set('session.cookie_lifetime', 3600);
// Hanya guna pada connection HTTPS sahaja
ini_set('session.cookie_secure', false);
// Cookie hanya boleh ditetapkan dengan menggunakan protokol HTTP sahaja
ini_set('session.cookie_httponly', true);
// Direktori simpanan session
ini_set('session.save_path', __DIR__ . '/storage/session');

session_start();