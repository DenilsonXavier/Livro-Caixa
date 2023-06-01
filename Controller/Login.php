
<?php
require_once '../class/Conect.php';
require_once '../class/Usuario.php';
class Login extends Conexao {
    public function validarUsuario($nick, $senha) {
        
        $this->conectar();

        $consulta = $this->conexao->prepare("SELECT nivel FROM usuario WHERE nick = ? AND senha = ?");
        $consulta->bind_param("ss", $nick, $senha);
        $consulta->execute();

        $resultado = $consulta->get_result();

        if ($resultado->num_rows === 1) {
            $row = $resultado->fetch_assoc();
            $nivel = $row['nivel'];
            
            if ($nivel === 'administrador' || $nivel === 'funcionario') {
               
                $this->fecharConexao();
                header("Location: ../index.php");
                return true;
            }
        }

       
        $consulta->close();
        $this->fecharConexao();
        return false;
    }
}
require_once 'Login.php';

$login = new Login();

if (isset($_POST['nick']) && isset($_POST['senha'])) {
    $nick = $_POST['nick'];
    $senha = $_POST['senha'];

    $usuarioValido = $login->validarUsuario($nick, $senha);
    if ($usuarioValido) {
        echo "Usuário válido. Redirecionando para index.php...";
        
        header("Location: ../index.php");
        exit();
    } else {
        echo "Usuário inválido. Por favor, verifique suas credenciais.";
        header("Location:../telaLogin.php?error=invalid");
     exit();
    }
}
