<?php

// Application configurations
define('APP_DIRECTORY', __DIR__);
define('APP_URL', 'http://localhost:9000');

// Database configurations
define('DB_DSN', 'mysql:unix_socket=/tmp/mysql_3306.sock;dbname=aplikasi;port=3306;charset=utf8mb4');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', null);
define('DB_OPTIONS', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => FALSE,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
]);