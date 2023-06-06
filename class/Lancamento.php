<?php
include_once 'Conect.php';
date_default_timezone_set('America/Sao_Paulo');

class Lancamento extends Conexao {
    
    public function adicionarLancamento($id_produto,$id_usuario,$quantidade, $vt, $forma_pagamento) {
        $this->conectar();
        $data = date('Y-m-d H:i:s', time());

  
        $consulta = $this->conexao->prepare("INSERT INTO `lancamento` (`id_lancamento`, `id_produto`, `id_usuario`, `quantidade`, `VT`, `dia`, `forma_pagamento`) VALUES (NULL, ?, ?, ?, ?, ?, ?)");
        $consulta->bind_param('iiidss',$id_produto, $id_usuario, $quantidade, $vt, $data, $forma_pagamento);
        $consulta->execute();
        
        if ($consulta->errno) {
             die("Erro ao adicionar lançamento: " . $consulta->error);
         }
 
         $consulta->close();
         $this->fecharConexao();
    }

    
    public function deletarLancamento($id_lancamento) {
        $this->conectar();

       
        $consulta = $this->conexao->prepare("DELETE FROM lancamento WHERE id_lancamento = ?");
        $consulta->bind_param("i", $id_lancamento);
        $consulta->execute();

        
        if ($consulta->errno) {
            die("Erro ao deletar lançamento: " . $consulta->error);
        }

        $consulta->close();
        $this->fecharConexao();
    }
    public function BuscarTodosLancamentos(){
        $this->conectar();
        $consulta = $this->conexao->prepare("SELECT lancamento.id_lancamento, lancamento.id_produto, lancamento.dia,lancamento.quantidade, lancamento.VT, produto.descricao, produto.tipo FROM `lancamento` join produto on lancamento.id_produto = produto.id_produto
         ORDER BY lancamento.dia ASC");  
        $consulta->execute();

        $rows[0] = null;
        $resultado = $consulta->get_result();
        for ($i=0; $row = $resultado->fetch_assoc() ; $i++) { 
            $rows[$i] = $row;
        }
        return $rows;
}
public function BuscarLancamentosHoje(){
    $this->conectar();
    $dia = date('Y-m-d', time());
    $consulta = $this->conexao->prepare("SELECT lancamento.id_lancamento, lancamento.id_produto, lancamento.dia,lancamento.quantidade, lancamento.VT, lancamento.forma_pagamento, produto.descricao, produto.tipo FROM `lancamento` join produto on lancamento.id_produto = produto.id_produto
     WHERE lancamento.dia LIKE '".$dia."%'ORDER BY lancamento.dia ASC");  
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