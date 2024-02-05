<?php

    // Conectar ao banco de dados usando PDO
    $pdo = new PDO('mysql:host=localhost;dbname=alura', 'root', '123456');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "Conectado.";
