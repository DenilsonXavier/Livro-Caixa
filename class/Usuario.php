<?php
class Usuario extends Conexao {

    public function adicionarUsuario($nome, $email) {
        $this->conectar();

       
        $consulta = $this->conexao->prepare("INSERT INTO usuarios (nome, email) VALUES (?, ?)");
        $consulta->bind_param("ss", $nome, $email);
        $consulta->execute();

        
        if ($consulta->errno) {
            die("Erro ao adicionar usuário: " . $consulta->error);
        }

        $consulta->close();
        $this->fecharConexao();
    }


    public function alterarUsuario($id, $nome, $email) {
        $this->conectar();

       
        $consulta = $this->conexao->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
        $consulta->bind_param("ssi", $nome, $email, $id);
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