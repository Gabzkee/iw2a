<?php
session_start(); // Inicia a sessão

// Se o usuário já estiver logado, redireciona para o dashboard
if (isset($_SESSION['id_usuario'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f0f2f5; }
        .login-container { background-color: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .login-container h2 { margin-bottom: 20px; }
        .login-container input { width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        .login-container button { width: 100%; padding: 10px; border: none; border-radius: 4px; background-color: #007bff; color: white; cursor: pointer; }
        .login-container .error { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Acessar o Sistema</h2>
        <?php
        // Exibe mensagem de erro se houver
        if (isset($_SESSION['login_error'])) {
            echo '<p class="error">' . $_SESSION['login_error'] . '</p>';
            unset($_SESSION['login_error']); // Limpa a mensagem após exibir
        }
        ?>
        <form action="login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Entrar</button>
        </form>
    </div>

</body>
</html>