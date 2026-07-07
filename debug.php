<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "=== DEBUG ===\n";
echo "PHP: " . phpversion() . "\n";

// Teste com 127.0.0.1 (TCP)
foreach (['127.0.0.1', 'localhost'] as $h) {
    try {
        $pdo = new PDO("mysql:host=$h;dbname=bancaesportiva", 'bancauser', 'banca123');
        echo "DB ($h): OK\n";
    } catch(Exception $e) {
        echo "DB ($h) ERROR: " . $e->getMessage() . "\n";
    }
}

// socket direto
foreach (['/var/run/mysqld/mysqld.sock', '/tmp/mysql.sock'] as $sock) {
    if (file_exists($sock)) {
        echo "Socket encontrado: $sock\n";
        try {
            $pdo = new PDO("mysql:unix_socket=$sock;dbname=bancaesportiva", 'bancauser', 'banca123');
            echo "DB (socket $sock): OK\n";
        } catch(Exception $e) {
            echo "DB (socket $sock) ERROR: " . $e->getMessage() . "\n";
        }
    } else {
        echo "Socket nao existe: $sock\n";
    }
}

// Checar se mariadb esta rodando
$proc = shell_exec('ps aux | grep mysql');
echo "Processos: $proc\n";
