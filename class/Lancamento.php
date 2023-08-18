<?php
include_once 'Conect.php';
date_default_timezone_set('America/Sao_Paulo');

class Lancamento extends Conexao {
    
    public function __construct() {
        parent::__construct();
   }
    
    public function adicionarLancamento($id_produto,$id_usuario,$quantidade, $vt, $forma_pagamento) {
        $this->conectar();
        $data = date('Y-m-d H:i:s', time());
  
        $consulta = $this->conexao->prepare("INSERT INTO `{$this->gettablenameLancamentos()}` (`id_lancamento`, `id_produto`, `id_usuario`, `quantidade`, `VT`, `dia`, `forma_pagamento`) VALUES (NULL, ?, ?, ?, ?, ?, ?)");
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

       
        $consulta = $this->conexao->prepare("DELETE FROM {$this->gettablenameLancamentos()} WHERE id_lancamento = ?");
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
        $consulta = $this->conexao->prepare("SELECT L.id_lancamento, L.id_produto, L.dia,L.quantidade, L.VT, L.forma_pagamento, P.descricao, P.tipo, U.nick FROM `{$this->gettablenameLancamentos()}` L join {$this->gettablenameProduto()} P on L.id_produto = P.id_produto join {$this->gettablenameUsuario()} U on L.id_usuario = U.id_usuario 
         ORDER BY L.dia ASC");  
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
    $consulta = $this->conexao->prepare("SELECT L.id_lancamento, L.id_produto, L.dia,L.quantidade, L.VT, L.forma_pagamento, P.descricao, P.tipo, U.nick FROM `{$this->gettablenameLancamentos()}` L join {$this->gettablenameProduto()} P on L.id_produto = P.id_produto join {$this->gettablenameUsuario()} U on L.id_usuario = U.id_usuario 
     WHERE L.dia LIKE '".$dia."%'ORDER BY L.dia ASC"); 
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