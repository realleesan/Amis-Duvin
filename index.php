<?php

// Handle static assets for PHP built-in web server
if (php_sapi_name() === 'cli-server') {
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if ($url === '/favicon.ico') {
        header("Location: https://media.base44.com/images/public/6a623336361c483b3f15558c/de2b27acb_LogoAmisDuVin.png");
        exit;
    }
    $file = __DIR__ . $url;
    if ($url !== '/' && is_file($file)) {
        return false;
    }
}

// Single Entry Point
require_once __DIR__ . '/core/App.php';

$app = new \Core\App();
$app->run();

