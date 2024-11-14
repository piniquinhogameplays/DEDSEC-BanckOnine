<?php
// Configurações do banco de dados
define('DB_HOST', 'localhost'); // Servidor do banco de dados (normalmente 'localhost')
define('DB_USER', 'root'); // Usuário do banco de dados
define('DB_PASS', ''); // Senha do banco de dados
define('DB_NAME', 'dedsec_bank'); // Nome do banco de dados

// Função para conectar ao banco de dados
function dbConnect() {
    // Cria a conexão usando mysqli
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Verifica a conexão
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }
    
    return $conn;
}

// Exemplo de uso da conexão
// $conexao = dbConnect();
?>
