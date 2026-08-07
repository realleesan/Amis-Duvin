<?php

// Handle static assets for PHP built-in web server
if (php_sapi_name() === 'cli-server') {
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $file = __DIR__ . $url;
    if ($url !== '/' && is_file($file)) {
        return false;
    }
}

// Single Entry Point
require_once __DIR__ . '/core/App.php';

$app = new \Core\App();
$app->run();

