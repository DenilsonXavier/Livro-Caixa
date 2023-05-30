
<?php
require_once '../class/Conect.php';
class Login extends Conexao {
    public function validarUsuario($nick = "ted", $senha = "senha123") {
        $this->conectar();

        $consulta = $this->conexao->prepare("SELECT nivel FROM usuario WHERE nick = ? AND senha = ?");
        $consulta->bind_param("ss", $nick, $senha);
        $consulta->execute();

        $resultado = $consulta->get_result();

        if ($resultado->num_rows === 1) {
            $row = $resultado->fetch_assoc();
            $nivel = $row['nivel'];
            
            if ($nivel === 'administrador' || $nivel === 'funcionario') {
                // Usuário válido com nível de acesso correto
                $this->fecharConexao();
                header("Location: index.php");
                exit();
            }
        }

        // Usuário inválido ou nível de acesso incorreto
        $consulta->close();
        $this->fecharConexao();
        return false;
    }
}
require_once 'Login.php';

$login = new Login();

// Testando com um usuário válido
$usuarioValido = $login->validarUsuario("ted", "senha123");
if ($usuarioValido) {
    echo "Usuário válido. Redirecionando para index.php...";
    // Redirecionar para index.php
} else {
    echo "Usuário inválido. Por favor, verifique suas credenciais.";
}

// Testando com um usuário inválido
$usuarioInvalido = $login->validarUsuario('joao', 'senha456');
if ($usuarioInvalido) {
    echo "Usuário válido. Redirecionando para index.php...";
    // Redirecionar para index.php
} else {
    echo "Usuário inválido. Por favor, verifique suas credenciais.";
}

?>