<?php

//Conexão com SQLite
/*$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");*/

$pdo = new PDO('mysql:host=localhost;dbname=alura', 'root', '123456');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->exec('ALTER TABLE videos ADD COLUMN image_path TEXT');
