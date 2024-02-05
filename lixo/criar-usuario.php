<?php

//Conexão com SQLite
//$dbPath = __DIR__ . '/banco.sqlite';
//$pdo = new PDO("sqlite:$dbPath");

// Conexão com MySQL
require_once __DIR__ . '/../conexao/conexao.php';

$email = $argv[1];
$password = $argv[2];

$hash = password_hash($password, PASSWORD_ARGON2ID);

$sql = 'INSERT INTO users (email, password) VALUES (?, ?);';
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $email);
$statement->bindValue(2, $hash);
$statement->execute();

//$hash === password_hash();

// Executar no terminal: php criar-usuario.php "email2@example.com" "123456"