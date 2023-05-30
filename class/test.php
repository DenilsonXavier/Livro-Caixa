<?php
require_once 'Usuario.php';

class AdicionarUsuario {
    public function adicionarUsuario() {
        $Usuario = new Usuario();
        $Usuario->adicionarUsuario("ted", "senha123", "Funcionario");
        echo "Usuário adicionado com sucesso!";
    }
}

$teste = new AdicionarUsuario();
$teste->adicionarUsuario();
?>
