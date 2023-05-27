<?php
class Produto extends Conexao {
   
    public function adicionarProduto($descricao, $tipo,$valor) {
        $this->conectar();

        
        $consulta = $this->conexao->prepare("INSERT INTO produtos (nome, preco) VALUES (?, ?)");
        $consulta->bind_param("sd",$descricao, $tipo,$valor);
        $consulta->execute();

     
        if ($consulta->errno) {
            die("Erro ao adicionar produto: " . $consulta->error);
        }

        $consulta->close();
        $this->fecharConexao();
    }

    public function alterarProduto($id_produto,$descricao, $tipo,$valor) {
        $this->conectar();

        $consulta = $this->conexao->prepare("UPDATE produtos SET nome = ?, preco = ? WHERE id_produto = ?");
        $consulta->bind_param("sdi", $descricao, $tipo,$valor, $id_produto);
        $consulta->execute();

        if ($consulta->errno) {
            die("Erro ao alterar produto: " . $consulta->error);
        }

        $consulta->close();
        $this->fecharConexao();
    }


    public function deletarProduto($id_produto) {
        $this->conectar();

        $consulta = $this->conexao->prepare("DELETE FROM produtos WHERE id_produto = ?");
        $consulta->bind_param("i", $id_produto);
        $consulta->execute();

      
        if ($consulta->errno) {
            die("Erro ao deletar produto: " . $consulta->error);
        }

        $consulta->close();
        $this->fecharConexao();
    }
}
?>