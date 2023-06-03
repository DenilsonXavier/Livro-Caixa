<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Tela de Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=25">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form class="login-form p-5 border rounded shadow" method="post" action="../Livro-Caixa/Controller/Login.php">
            <h2 class="text-center mb-4">BEM VINDO</h2>
            <?php
            if (isset($_GET['error']) && $_GET['error'] === 'invalid') {
                echo '<p class="text-danger">Nick ou senha incorretos. Por favor, verifique suas credenciais.</p>';
            }
            ?>
            <div class="input-group">
                <span class="input-group-text">Usuario</span>
                <input type="text" name="nick" class="form-control"  required>
            </div>
            <div class="input-group">
                <span class="input-group-text">Senha</span>
                <input type="password" name="senha" class="form-control"  required>
            </div>
            <div class="input-group">
                <input type="submit" value="Entrar" class="btn btn-success btn-block">
            </div>
        </form>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
