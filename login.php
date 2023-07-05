<?php 
session_start();
session_unset();
session_destroy();
session_abort();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Tela de Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=25">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form class="login-form p-5 border rounded shadow" method="post" action="./Controller/LoginCrontroller.php">
            <h2 class="text-center mb-4 h1">BEM-VINDO</h2>
            <?php
            ?>
            <div class="input-group my-1">
                <span class="input-group-text">Usuario</span>
                <input type="text" name="nick" id="nick" class="form-control"  required>
            </div>
            <div class="input-group my-1">
                <span class="input-group-text">Senha</span>
                <input type="password" name="senha" id="senha" class="form-control"  required>
            </div>
            <div class="input-group my-1">
                <input type="submit" value="Entrar"onclick="validateForm()" class="btn btn-success btn-block">
            </div>
        </form>
    </div>


    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        function validateForm() {
            var nick = document.getElementById("nick").value;
            var senha = document.getElementById("senha").value;
            
            if (nick.trim() === "" || senha.trim() === "") {
                alert("Por favor, preencha todos os campos.");
                return false;
            }
            
            return true;
        }
    </script>
</body>
</html>