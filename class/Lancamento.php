<?php
class Lancamento extends Conexao {
    
    public function adicionarLancamento($quantidade, $VT,$dia,$tipo) {
        $this->conectar();

       
        $consulta = $this->conexao->prepare("INSERT INTO lancamentos (quantidade, VT, dia,tipo ) VALUES (?, ?)");
        $consulta->bind_param("sd", $quantidade, $VT,$dia,$tipo);
        $consulta->execute();

       
        if ($consulta->errno) {
            die("Erro ao adicionar lançamento: " . $consulta->error);
        }

        $consulta->close();
        $this->fecharConexao();
    }

    
    public function alterarLancamento($id_lancamento,$id_produto,$id_usuario,$quantidade, $VT,$dia,$tipo) {
        $this->conectar();

        
        $consulta = $this->conexao->prepare("UPDATE lancamentos SET quantidade = ?, VT = ?,dia = ?,tipo = ? WHERE id_lancamento = ?,id_produto = ?,id_usuario = ?");
        $consulta->bind_param("sdi", $quantidade, $VT,$dia,$tipo, $id_lancamento,$id_produto,$id_usuario );
        $consulta->execute();

        
        if ($consulta->errno) {
            die("Erro ao alterar lançamento: " . $consulta->error);
        }

        $consulta->close();
        $this->fecharConexao();
    }

    
    public function deletarLancamento($id_lancamento,$id_produto,$id_usuario) {
        $this->conectar();

       
        $consulta = $this->conexao->prepare("DELETE FROM lancamento WHERE id_lancamento = ?,id_produto = ?,id_usuario = ?");
        $consulta->bind_param("i", $id_lancamento,$id_produto,$id_usuario);
        $consulta->execute();

        
        if ($consulta->errno) {
            die("Erro ao deletar lançamento: " . $consulta->error);
        }

        $consulta->close();
        $this->fecharConexao();
    }
}
?>