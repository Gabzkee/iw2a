<?php
// Inicia a sessão
session_start();

// Verifica se o usuário está logado. Se não, redireciona para a página de login.
if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit();
}

// Pega o nome do usuário da sessão para exibir uma mensagem de boas-vindas
$nome_usuario = $_SESSION['nome'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .welcome { font-size: 24px; }
        .logout { margin-top: 20px; display: inline-block; padding: 10px 15px; background-color: #dc3545; color: white; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>

    <h1 class="welcome">Bem-vindo, <?php echo htmlspecialchars($nome_usuario); ?>!</h1>
    <p>Você está na área protegida do sistema.</p>
    <form action="consultar.html">
    <button type="submit">Ir para página de consultas</button>
    </form>
    <a href="logout.php" class="logout">Sair</a>

</body>
</html>