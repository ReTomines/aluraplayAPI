<?php

try {
    $tabelas = ['videos', 'users'];

    for ($i = 0; $i < count($tabelas); $i++) {
        $nomeTabela = $tabelas[$i];

        // Verificar se a tabela existe
        $consulta = $pdo->prepare("SHOW TABLES LIKE :tabela");
        $consulta->bindParam(':tabela', $nomeTabela);
        $consulta->execute();
        $tabelaExiste = $consulta->rowCount() > 0;

        // Se não existe, criar
        if (!$tabelaExiste) {
            $criarTabelaSQL = "CREATE TABLE $nomeTabela (id INTEGER PRIMARY KEY AUTO_INCREMENT , ";

            if ($nomeTabela == 'videos') {
                $criarTabelaSQL .= "url VARCHAR(255), title VARCHAR(255)";
            } elseif ($nomeTabela == 'users') {
                $criarTabelaSQL .= "email VARCHAR(255), password VARCHAR(255)";
            }

            $criarTabelaSQL .= ");";

            $pdo->exec($criarTabelaSQL);
            echo "Tabela '$nomeTabela' criada com sucesso.";
        } else {
            echo "A tabela '$nomeTabela' já existe.";
        }
    }

} catch (PDOException $e) {
    echo "Erro de conexão com o banco de dados: " . $e->getMessage();
}
