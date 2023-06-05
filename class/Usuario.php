<?php
require_once 'Conect.php';
class Usuario extends Conexao {

    public function adicionarUsuario($nick,$senha,$Nivel) {
        $this->conectar();

       
        $consulta = $this->conexao->prepare("INSERT INTO Usuario (nick,senha,Nivel) VALUES (?, ?, ?)");
        $consulta->bind_param("sss",$nick,$senha,$Nivel);
        $consulta->execute();

        
        if ($consulta->errno) {
            die("Erro ao adicionar usuário: " . $consulta->error);
        }

        $consulta->close();
        $this->fecharConexao();
    }


    public function alterarUsuario($id_usuario,$nick,$senha,$Nivel) {
        $this->conectar();

       
        $consulta = $this->conexao->prepare("UPDATE Usuario SET nick = ?, senha = ?, Nivel = ? WHERE id_usuario  = ?");
        $consulta->bind_param("ssi",$nick,$senha,$Nivel, $id_usuario );
        $consulta->execute();

        if ($consulta->errno) {
            die("Erro ao alterar usuário: " . $consulta->error);
        }

        $consulta->close();
        $this->fecharConexao();
    }

    
    public function deletarUsuario($id_usuario) {
        $this->conectar();

        
        $consulta = $this->conexao->prepare("DELETE FROM Usuario WHERE id_usuario = ?");
        $consulta->bind_param("i", $id_usuario);
        $consulta->execute();

       
        if ($consulta->errno) {
            die("Erro ao deletar usuário: " . $consulta->error);
        }

        $consulta->close();
        $this->fecharConexao();
    }    
    public function BuscarTodosProdutos(){
        $this->conectar();
        $consulta = $this->conexao->prepare("SELECT * FROM Usuario ORDER BY nick ASC");  
        $consulta->execute();

        $rows[0] = null;
        $resultado = $consulta->get_result();
        for ($i=0; $row = $resultado->fetch_assoc() ; $i++) { 
            $rows[$i] = $row;
        }
        return $rows;
}
}
?>