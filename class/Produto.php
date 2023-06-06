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

    public function deletarProduto($id_produto) {
        session_start();
        if ($id_produto == 1 || $id_produto == 2) {
            $_SESSION['Error_mp'] = 1;
            exit;
        }
        
        $this->conectar();
        $selectProduto = $this->conexao->prepare("SELECT * FROM produto WHERE id_produto = ? ");
        $selectProduto->bind_param("i", $id_produto);
        $selectProduto->execute();
        $id_n = $selectProduto->get_result();
        $id_n = $id_n->fetch_array(MYSQLI_NUM);

        if($id_n['tipo'] == 'entrada'){
            $id_novo = 1;
        }else{
            $id_novo = 2;
        }

        $updateProduto = $this->conexao->prepare("UPDATE `lancamento` SET `id_produto` = ? WHERE `lancamento`.`id_produto` = ?");
        $updateProduto->bind_param('ii', $id_novo , $id_produto);
        $updateProduto->execute();
    
    
        $consultaProduto = $this->conexao->prepare("DELETE FROM produto WHERE id_produto = ?");
        $consultaProduto->bind_param("i", $id_produto);
        $consultaProduto->execute();
    
        if ($consultaProduto->errno) {
            die("Erro ao excluir produto: " . $consultaProduto->error);
        }
    
        $consultaProduto->close();
        $this->fecharConexao();
    }
    
    public function BuscarTodosProdutos(){
        $this->conectar();
        $consulta = $this->conexao->prepare("SELECT * FROM produto ORDER BY descricao ASC");  
        $consulta->execute();
        $rows[0] = null;
        $resultado = $consulta->get_result();
        for ($i=0; $row = $resultado->fetch_assoc() ; $i++) { 
            $rows[$i] = $row;
        }
        return $rows;
        $consulta->close();
        $this->fecharConexao();
        
}


}
?>