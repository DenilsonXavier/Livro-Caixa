<?php
require_once 'Conect.php';

class Usuario extends Conexao {

    public function adicionarUsuario($nick, $senha, $Nivel) {
        $this->conectar();

        $senhaHash = md5($senha); 

        $consulta = $this->conexao->prepare("INSERT INTO Usuario (nick, senha, Nivel) VALUES (?, ?, ?)");
        $consulta->bind_param("sss", $nick, $senhaHash, $Nivel);
        $consulta->execute();

        if ($consulta->errno) {
            die("Erro ao adicionar usuário: " . $consulta->error);
        }

        $consulta->close();
        $this->fecharConexao();
    }

    public function alterarUsuario($id_usuario, $nick, $senha, $Nivel) {
        $this->conectar();

        $senhaHash = md5($senha);

        $consulta = $this->conexao->prepare("UPDATE Usuario SET nick = ?, senha = ?, Nivel = ? WHERE id_usuario  = ?");
        $consulta->bind_param("sssi", $nick, $senhaHash, $Nivel, $id_usuario);
        $consulta->execute();

        if ($consulta->errno) {
            die("Erro ao alterar usuário: " . $consulta->error);
        }

        $consulta->close();
        $this->fecharConexao();
    }

    
    public function deletarUsuario($id_usuario) {
        $this->conectar();

        if($_SESSION['id_usuario'] == $id_usuario){
            $_SESSION['error_mu'] = 1;
            header("Location: ../adm.php");
            exit;
        }

        $updateLancamento = $this->conexao->prepare("UPDATE `lancamento` SET `id_usuario` = ? WHERE `lancamento`.`id_usuario` = ?");
        $updateLancamento->bind_param('ii', $_SESSION['id_usuario'], $id_usuario);
        $updateLancamento->execute();

        $excluirLancamentos = $this->conexao->prepare("DELETE FROM lancamento WHERE id_usuario = ?");
        $excluirLancamentos->bind_param("i", $id_usuario);
        $excluirLancamentos->execute();
    
       
        if ($excluirLancamentos->errno) {
            die("Erro ao excluir os registros de lancamento: " . $excluirLancamentos->error);
        }
    
   
        $consulta = $this->conexao->prepare("DELETE FROM Usuario WHERE id_usuario = ?");
        $consulta->bind_param("i", $id_usuario);
        $consulta->execute();
    
     
        if ($consulta->errno) {
            die("Erro ao deletar usuário: " . $consulta->error);
        }
    
        $consulta->close();
        $excluirLancamentos->close();
        $this->fecharConexao();
    }
    public function buscarTodosProdutos() {
        $this->conectar();
        $consulta = $this->conexao->prepare("SELECT * FROM Usuario ORDER BY nick ASC");  
        $consulta->execute();

        $rows[0] = null;
        $resultado = $consulta->get_result();
        for ($i=0; $row = $resultado->fetch_assoc(); $i++) { 
            $rows[$i] = $row;
        }
        return $rows;
    }
}
?>
