<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "=== DEBUG CONN ===\n";

// Testa exatamente o que Conn.php faz
try {
    $dsn = 'mysql:host=127.0.0.1;dbname=bancaesportiva;charset=utf8';
    $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
    $conn = new PDO($dsn, 'bancauser', 'banca123', $options);
    echo "PDO conectou OK\n";
    
    $conn->exec('SET NAMES utf8');
    echo "SET NAMES utf8 OK\n";
    
    $conn->exec('SET CHARACTER SET utf8');
    echo "SET CHARACTER SET utf8 OK\n";
    
    try {
        $conn->exec("SET time_zone = 'America/Sao_Paulo'");
        echo "SET time_zone OK\n";
    } catch(Exception $e) {
        echo "SET time_zone ERRO: " . $e->getMessage() . "\n";
        // tenta UTC offset
        $conn->exec("SET time_zone = '-03:00'");
        echo "SET time_zone offset OK\n";
    }
    
    // Testa query
    $r = $conn->query("SELECT COUNT(*) FROM sis_dados")->fetchColumn();
    echo "Query OK, sis_dados rows: $r\n";
    
} catch(PDOException $e) {
    echo "PDO ERRO: " . $e->getMessage() . "\n";
}
