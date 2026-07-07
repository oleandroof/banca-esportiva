<?php
ini_set('memory_limit', '-1');
try{
		$host = getenv('DB_HOST') ?: '127.0.0.1';
		$dbname = getenv('DB_NAME') ?: 'bancaesportiva';
		$user = getenv('DB_USER') ?: 'bancauser';
		$pass = getenv('DB_PASS') ?: 'banca123';
		$conexao = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$conexao ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		echo 'ERROR: ' . $e->getMessage();
	}
