<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "=== DEBUG ===\n";
echo "PHP: " . phpversion() . "\n";

// Teste banco
try {
    $pdo = new PDO("mysql:host=localhost;dbname=bancaesportiva", 'bancauser', 'banca123');
    echo "DB: OK\n";
} catch(Exception $e) {
    echo "DB ERROR: " . $e->getMessage() . "\n";
}

// Teste autoloader
try {
    include 'vendor/autoload.php';
    echo "Autoloader: OK\n";
} catch(Throwable $e) {
    echo "Autoloader ERROR: " . $e->getMessage() . " em " . $e->getFile() . ":" . $e->getLine() . "\n";
    exit;
}

// Teste boot
try {
    include 'app/boot.inc.php';
    echo "Boot: OK\n";
} catch(Throwable $e) {
    echo "Boot ERROR: " . $e->getMessage() . " em " . $e->getFile() . ":" . $e->getLine() . "\n";
}
