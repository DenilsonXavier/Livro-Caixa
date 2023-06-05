<?php
require_once 'Conect.php';
class Produto extends Conexao {
   
    public function adicionarProduto($descricao, $tipo) {
        $this->conectar();
    
       
        $consulta = $this->conexao->prepare("INSERT INTO produto (descricao, tipo) VALUES (?, ?)");
        $consulta->bind_param("ss", $descricao, $tipo);
        $consulta->execute();
    

        if ($consulta->errno) {
            die("Erro ao adicionar produto: " . $consulta->error);
        }
    
        $consulta->close();
        $this->fecharConexao();
    }

    public function alterarProduto($id_produto,$descricao, $tipo) {
        $this->conectar();

        $consulta = $this->conexao->prepare("UPDATE produto SET descricao = ?,tipo = ? WHERE id_produto = ?");

        $consulta->bind_param("ssdi", $descricao, $tipo, $id_produto);

        $consulta->bind_param("sdi", $descricao, $tipo, $id_produto);

        $consulta->execute();

        if ($consulta->errno) {
            die("Erro ao alterar produto: " . $consulta->error);
        }

        $consulta->close();
        $this->fecharConexao();
    }


    public function deletarProduto($id_produto) {
        $this->conectar();

        $consulta = $this->conexao->prepare("DELETE FROM produto WHERE id_produto = ?");
        $consulta->bind_param("i", $id_produto);
        $consulta->execute();

      
        if ($consulta->errno) {
            die("Erro ao deletar produto: " . $consulta->error);
        }

        $consulta->close();
        $this->fecharConexao();
    }
    public function BuscarProduto($descricao) {
        $this->conectar();

    $consulta = $this->conexao->prepare("SELECT * FROM produto WHERE descricao = ?");
    $consulta->bind_param("s", $descricao);
    $consulta->execute();

    $resultado = $consulta->get_result();

    if ($resultado->num_rows > 0) {
       
        while ($row = $resultado->fetch_assoc()) {
            
            echo "id_produto: " . $row['id_produto'] . "<br>";
            echo "Descrição: " . $row['descricao'] . "<br>";
            echo "Tipo: " . $row['tipo'] . "<br>";
          
        }
    } else {
        echo "Nenhum produto encontrado.";
    }
        $consulta->close();
        $this->fecharConexao();
    }
    
    public function BuscarTodosProdutos(){
        $this->conectar();
        $consulta = $this->conexao->prepare("SELECT * FROM produto");  
        $consulta->execute();

        $resultado = $consulta->get_result();
        for ($i=0; $row = $resultado->fetch_assoc() ; $i++) { 
            $rows[$i] = $row;
        }
        return $rows;
}


}
?>