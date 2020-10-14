<?php

$key = 'web_login_' . session_id();

unset($_SESSION[$key]);

$_SESSION['notifikasi'] = 'Anda berjaya log keluar daripada aplikasi';

$url = url('/');
header("Location: {$url}");
die();