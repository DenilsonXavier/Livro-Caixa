<?php
class Usuario extends Conexao {

    public function adicionarUsuario($nome,$nick,$senha,$Nivel) {
        $this->conectar();

       
        $consulta = $this->conexao->prepare("INSERT INTO usuarios (nome,nick,senha,Nivel) VALUES (?, ?)");
        $consulta->bind_param("ss", $nome, $nick,$senha,$Nivel);
        $consulta->execute();

        
        if ($consulta->errno) {
            die("Erro ao adicionar usuário: " . $consulta->error);
        }

        $consulta->close();
        $this->fecharConexao();
    }


    public function alterarUsuario($id_usuario ,$nome,$nick,$senha,$Nivel) {
        $this->conectar();

       
        $consulta = $this->conexao->prepare("UPDATE usuarios SET nome = ?,nick = ?, senha = ?, Nivel = ? WHERE id_usuario  = ?");
        $consulta->bind_param("ssi",$nome,$nick,$senha,$Nivel, $id_usuario );
        $consulta->execute();

        if ($consulta->errno) {
            die("Erro ao alterar usuário: " . $consulta->error);
        }

        $consulta->close();
        $this->fecharConexao();
    }

    
    public function deletarUsuario($id) {
        $this->conectar();

        
        $consulta = $this->conexao->prepare("DELETE FROM usuarios WHERE id = ?");
        $consulta->bind_param("i", $id);
        $consulta->execute();

       
        if ($consulta->errno) {
            die("Erro ao deletar usuário: " . $consulta->error);
        }

        $consulta->close();
        $this->fecharConexao();
    }
}
?>