<?php
// Inicia a sessão
session_start();

// Inclui o arquivo de conexão
require_once 'conexao.php';

// Verifica se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = $_POST['senha'];

    // Prepara a consulta para buscar o usuário pelo email
    $sql = "SELECT id_usuario, nome, email, senha FROM usuarios WHERE email = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    // Verifica se encontrou o usuário
    if (mysqli_num_rows($resultado) == 1) {
        $usuario = mysqli_fetch_assoc($resultado);

        // Verifica se a senha fornecida corresponde ao hash no banco de dados
        if (password_verify($senha, $usuario['senha'])) {
            // Senha correta, cria a sessão
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nome'] = $usuario['nome'];

            // Redireciona para a página protegida
            header("Location: dashboard.php");
            exit();
        } else {
            // Senha incorreta
            $_SESSION['login_error'] = "Email ou senha inválidos.";
            header("Location: index.php");
            exit();
        }
    } else {
        // Usuário não encontrado
        $_SESSION['login_error'] = "Email ou senha inválidos.";
        header("Location: index.php");
        exit();
    }

    // Fecha o statement e a conexão
    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
} else {
    // Se o acesso não for via POST, redireciona para a página de login
    header("Location: index.php");
    exit();
}
?>