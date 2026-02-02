<?php
session_start();
require_once __DIR__ . '/../app/helpers/env.php';

// Base path
define('BASE_PATH', dirname(__DIR__));

// Load .env
$envFile = BASE_PATH . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (str_starts_with(trim($line), '#')) continue;
        [$key, $value] = explode('=', $line, 2);
        $_ENV[$key] = trim($value);
    }
}

// Auto environment
$env = $_ENV['APP_ENV'] ?? 'production';

if ($env === 'local') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);
}

// Core loader
require_once BASE_PATH . '/app/core/App.php';
require_once BASE_PATH . '/app/core/Router.php';
require_once BASE_PATH . '/app/core/Controller.php';

new App();
