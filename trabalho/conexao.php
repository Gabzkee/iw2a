<?php
// Definições do banco de dados
$servidor = "localhost"; // Geralmente localhost
$usuario_db = "root";    // Usuário do seu banco de dados
$senha_db = "";          // Senha do seu banco de dados
$banco = "estoque";      // Nome do banco de dados

// Cria a conexão
$conexao = mysqli_connect($servidor, $usuario_db, $senha_db, $banco);

// Verifica a conexão
if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Opcional: Define o charset para evitar problemas com acentos
mysqli_set_charset($conexao, "utf8");
?>