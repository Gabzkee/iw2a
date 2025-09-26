<?php
$servidor = "localhost";
$usuario_db = "root";    // Usuário do banco de dados
$senha_db = "";          // Senha do banco de dados
$banco = "trabalho";      // Nome do banco de dados

// Cria a conexão
$conexao = mysqli_connect($servidor, $usuario_db, $senha_db, $banco);

// Verifica a conexão
if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Registrar
$id_item=,