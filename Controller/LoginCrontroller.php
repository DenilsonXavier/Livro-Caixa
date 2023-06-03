
<?php
require_once '../class/Conect.php';
require_once '../class/Usuario.php';
class Login extends Conexao {
    public function validarUsuario($nick, $senha) {
        
        $this->conectar();

        $consulta = $this->conexao->prepare("SELECT * FROM usuario WHERE nick = ? AND senha = ?");
        $consulta->bind_param("ss", $nick, $senha);
        $consulta->execute();

        $resultado = $consulta->get_result();

        if ($resultado->num_rows === 1) {
            $row = $resultado->fetch_assoc();
            return $row;
        }

       
        $consulta->close();
        $this->fecharConexao();
        return false;
    }
}


$login = new Login;

    $usuario = $login->validarUsuario($_POST['nick'],$_POST['senha']);

    if ($usuario != false) {
        
        session_start();
        $_SESSION['nick'] = $usuario['nick'];
        $_SESSION['nivel'] = $usuario['Nivel'];
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        header('Location: ../index.php');
    }