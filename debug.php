<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    echo "PHP ERROR [$errno]: $errstr em $errfile:$errline\n";
    return true;
});
set_exception_handler(function($e) {
    echo "EXCEPTION: " . $e->getMessage() . " em " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo $e->getTraceAsString();
});

echo "=== DEBUG APP ===\n";

// Inclui o autoloader
require_once 'vendor/autoload.php';
echo "Autoloader OK\n";

// Seta o DB_HOST para forcar TCP antes de qualquer coisa
putenv('DB_HOST=127.0.0.1');

// Carrega o config
$_SERVER['SERVER_NAME'] = 'banca-esportiva.onrender.com';
$_SERVER['REQUEST_URI'] = '/';
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['HTTPS'] = 'on';

try {
    $config = include 'inc.config.php';
    echo "Config OK\n";
} catch(Throwable $e) {
    echo "Config ERROR: " . $e->getMessage() . " em " . $e->getFile() . ":" . $e->getLine() . "\n";
}

try {
    \app\APP::Initialize();
} catch(Throwable $e) {
    echo "APP ERROR: " . $e->getMessage() . " em " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo $e->getTraceAsString();
}
